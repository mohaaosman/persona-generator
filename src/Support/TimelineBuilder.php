<?php

namespace PersonaGenerator\Support;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use PersonaGenerator\Contracts\LocaleRepository;
use PersonaGenerator\ValueObjects\EducationEntry;
use PersonaGenerator\ValueObjects\EmploymentEntry;
use PersonaGenerator\ValueObjects\Timeline;

/**
 * Builds a single internally-consistent life timeline. Everything hangs off one
 * birth year: age -> education years -> first job after graduation, with no
 * overlapping employment and exactly one current position.
 */
class TimelineBuilder
{
    private const MIN_AGE = 24;

    private const MAX_AGE = 58;

    private const BACHELOR_YEARS = 4;

    /** Career family used when a field declares none / an unknown one. */
    private const DEFAULT_FAMILY = 'public_admin';

    /** Relative selection weights per employer sector (public-sector-first). */
    private const SECTOR_WEIGHTS = ['government' => 60, 'ngo' => 30, 'private' => 15];

    /** Probability a persona has one short gap between two positions. */
    private const GAP_PROBABILITY = 0.30;

    /** Probability a degree is earned in the persona's home country. */
    private const HOME_UNIVERSITY_PROBABILITY = 0.80;

    /** Probability a position is with an employer in the persona's home region. */
    private const HOME_EMPLOYER_PROBABILITY = 0.65;

    private readonly LocaleProfile $profile;

    /** Data key holding local-language labels ('so', 'ar', ...). */
    private readonly string $lang;

    private string $homeRegion = '';

    private string $homeCountry = '';

    public function __construct(
        private readonly LocaleRepository $locale,
        private readonly SeededRandom $random,
        ?LocaleProfile $profile = null,
    ) {
        $this->profile = $profile ?? new LocaleProfile($locale);
        $this->lang = $this->detectLocalKey();
    }

    public function build(): Timeline
    {
        $now = CarbonImmutable::now();
        $currentYear = (int) $now->format('Y');

        $targetAge = $this->random->int(self::MIN_AGE, self::MAX_AGE);
        $dob = $now->subYears($targetAge)->subDays($this->random->int(0, 364))->startOfDay();
        $age = (int) $dob->diffInYears($now);
        $birthYear = (int) $dob->format('Y');

        [$region, $city] = $this->pickHome();
        $this->homeRegion = $region;
        $this->homeCountry = $this->profile->country($region);

        $field = $this->random->pick($this->locale->fields());
        $family = $field['family'] ?? self::DEFAULT_FAMILY;
        $education = $this->buildEducation($birthYear, $currentYear, $field);
        $bachelorEndYear = $education->first()->endYear;

        $employment = $this->buildEmployment($bachelorEndYear, $now, $family);
        $languages = $this->buildLanguages($education, $region);

        return new Timeline(
            dob: $dob,
            age: $age,
            education: $education,
            employment: $employment,
            languages: $languages,
            region: $region,
            city: $city,
        );
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function pickHome(): array
    {
        $regions = $this->locale->regions();
        $region = $this->random->pick(array_keys($regions));
        $city = $this->random->pick($regions[$region]);

        return [$region, $city];
    }

    /**
     * @param  array<string, string>  $field
     * @return Collection<int, EducationEntry>
     */
    private function buildEducation(int $birthYear, int $currentYear, array $field): Collection
    {
        $degrees = collect($this->locale->degrees());
        $family = $field['family'] ?? self::DEFAULT_FAMILY;
        $byLevel = function (string $level) use ($degrees, $family): array {
            $atLevel = $degrees->where('level', $level);
            $suited = $atLevel->filter(fn (array $d) => ! isset($d['families']) || in_array($family, $d['families'], true));

            return $this->random->pick(($suited->isNotEmpty() ? $suited : $atLevel)->values()->all());
        };

        $entries = collect();

        // Bachelor — the anchor degree. Entry age 18-20, four-year programme.
        $bachelorStart = $birthYear + $this->random->int(18, 20);
        $bachelorEnd = $bachelorStart + self::BACHELOR_YEARS;
        $entries->push($this->makeEducation($byLevel('bachelor'), $field, $bachelorStart, $bachelorEnd));
        $lastEnd = $bachelorEnd;

        // Master — more likely for older candidates.
        $masterChance = $this->ageFromYear($birthYear, $currentYear) >= 30 ? 0.5 : 0.25;
        if ($this->random->bool($masterChance)) {
            $mStart = $lastEnd + $this->random->int(0, 3);
            $mEnd = $mStart + 2;
            if ($mEnd <= $currentYear) {
                $entries->push($this->makeEducation($byLevel('master'), $field, $mStart, $mEnd));
                $lastEnd = $mEnd;

                // PhD — only for clearly older candidates, and only if it fits.
                if ($this->ageFromYear($birthYear, $currentYear) >= 38 && $this->random->bool(0.3)) {
                    $pStart = $lastEnd + $this->random->int(0, 2);
                    $pEnd = $pStart + $this->random->int(3, 4);
                    if ($pEnd <= $currentYear) {
                        $entries->push($this->makeEducation($byLevel('phd'), $field, $pStart, $pEnd));
                    }
                }
            }
        }

        // Mark the most advanced (last) degree as highest.
        return $entries->map(fn (EducationEntry $e, int $i) => new EducationEntry(
            degree: $e->degree,
            degreeSo: $e->degreeSo,
            field: $e->field,
            fieldSo: $e->fieldSo,
            institution: $e->institution,
            country: $e->country,
            startYear: $e->startYear,
            endYear: $e->endYear,
            isHighest: $i === $entries->count() - 1,
            lang: $e->lang,
        ))->values();
    }

    /**
     * @param  array<string, mixed>  $degree
     * @param  array<string, string>  $field
     */
    private function makeEducation(array $degree, array $field, int $startYear, int $endYear): EducationEntry
    {
        $universities = $this->locale->universities();
        $home = array_keys(array_filter($universities, fn (string $country) => $country === $this->homeCountry));
        $institution = ($home !== [] && $this->random->bool(self::HOME_UNIVERSITY_PROBABILITY))
            ? $this->random->pick($home)
            : $this->random->pick(array_keys($universities));

        return new EducationEntry(
            degree: $degree['en'],
            degreeSo: $this->local($degree),
            field: $field['en'],
            fieldSo: $this->local($field),
            institution: $institution,
            country: $universities[$institution],
            startYear: $startYear,
            endYear: $endYear,
            isHighest: false,
            lang: $this->lang,
        );
    }

    /**
     * @return Collection<int, EmploymentEntry>
     */
    private function buildEmployment(int $bachelorEndYear, CarbonImmutable $now, string $family): Collection
    {
        $currentYear = (int) $now->format('Y');
        $firstJobYear = min($bachelorEndYear + 1, $currentYear);

        $start = CarbonImmutable::create($firstJobYear, $this->random->int(1, 12), 1);
        $totalMonths = max(1, (int) $start->diffInMonths($now));

        // ~18 months minimum per position, capped at four positions.
        $spanCount = max(1, min(4, intdiv($totalMonths, 18)));
        $spanCount = $this->random->int(1, $spanCount);

        // At most one short gap, placed after a randomly chosen earlier position
        // (never before the current role). Needs at least two positions.
        $gapAfterIndex = ($spanCount >= 2 && $this->random->bool(self::GAP_PROBABILITY))
            ? $this->random->int(0, $spanCount - 2)
            : -1;

        $ladder = $this->familyLadder($family);
        $tiers = ['junior', 'mid', 'senior'];
        $descriptions = $this->descriptionTemplates();
        $entries = collect();

        for ($i = 0; $i < $spanCount; $i++) {
            $isLast = $i === $spanCount - 1;
            $tier = $tiers[min($i, count($tiers) - 1)];
            $role = $this->random->pick($ladder[$tier]);
            $employer = $this->pickEmployer($family);
            $grade = 'Grade '.(3 + ($i * 2));

            if ($isLast) {
                $end = null;
                $isCurrent = true;
            } else {
                $remainingSpans = $spanCount - 1 - $i;
                $maxYears = max(1, (int) floor($start->diffInYears($now)) - $remainingSpans);
                $durYears = $this->random->int(1, min(6, $maxYears));
                $end = $start->addYears($durYears);
                if ($end >= $now) {
                    $end = $now->subMonths(1);
                }
                $isCurrent = false;
            }

            $entries->push(new EmploymentEntry(
                role: $role['en'],
                roleSo: $this->local($role),
                organisation: $employer['name'],
                grade: $grade,
                region: $employer['region'],
                startDate: $start,
                endDate: $end,
                isCurrent: $isCurrent,
                description: $this->describe($descriptions['en'], $role['en'], $employer),
                descriptionSo: $this->describe(
                    $descriptions['local'],
                    $this->local($role),
                    $employer,
                    $this->profile->localRegionName($employer['region']),
                ),
                lang: $this->lang,
            ));

            if (! $isLast && $end !== null) {
                // Base hand-over of 0-6 months, plus a longer gap at the chosen boundary.
                $months = $this->random->int(0, 6);
                if ($i === $gapAfterIndex) {
                    $months += $this->random->int(6, 14);
                }
                $start = $end->addMonths($months);
                if ($start >= $now) {
                    $start = $now->subMonths(1);
                }
            }
        }

        return $entries->values();
    }

    /**
     * Resolve a career family's tiered role ladder, falling back to the default
     * family when the field's family has no ladder.
     *
     * @return array<string, array<int, array{en: string, so: string}>>
     */
    private function familyLadder(string $family): array
    {
        $ladders = $this->locale->jobTitles();

        return $ladders[$family] ?? $ladders[self::DEFAULT_FAMILY];
    }

    /**
     * Pick an employer that hires the persona's career family, weighting
     * selection toward the public sector and toward the home region.
     *
     * @return array{name: string, sector: string, region: string}
     */
    private function pickEmployer(string $family): array
    {
        $employers = $this->locale->employers();

        // Where the locale says so, government posts are for nationals only.
        if ($this->profile->governmentHomeOnly()) {
            $eligible = array_filter($employers, fn (array $e) => ($e['sector'] ?? 'government') !== 'government'
                || ($e['region'] ?? null) === $this->homeRegion);
            $employers = $eligible !== [] ? $eligible : $employers;
        }

        // Employers declare the career families they hire; none declared = any.
        $hiring = array_filter($employers, fn (array $e) => ! isset($e['families']) || in_array($family, $e['families'], true));

        $bySector = [];
        foreach ($hiring !== [] ? $hiring : $employers as $employer) {
            $bySector[$employer['sector'] ?? 'government'][] = $employer;
        }

        $weights = [];
        foreach (self::SECTOR_WEIGHTS as $sector => $weight) {
            if (! empty($bySector[$sector])) {
                $weights[$sector] = $weight;
            }
        }

        $sector = $weights === [] ? array_key_first($bySector) : $this->random->weightedKey($weights);
        $pool = $bySector[$sector];

        // Most careers stay close to home.
        $home = array_values(array_filter($pool, fn (array $e) => ($e['region'] ?? null) === $this->homeRegion));
        if ($home !== [] && $this->random->bool($this->profile->homeEmployerProbability(self::HOME_EMPLOYER_PROBABILITY))) {
            $pool = $home;
        }

        return $this->random->pick($pool);
    }

    /**
     * @return array{en: array<int, string>, local: array<int, string>}
     */
    private function descriptionTemplates(): array
    {
        $templates = $this->locale->templates()['employment_description'] ?? [];
        $en = $templates['en'] ?? ['Served as :role at :organisation in :region.'];

        return [
            'en' => $en,
            'local' => $templates[$this->lang] ?? $templates['so'] ?? $en,
        ];
    }

    /**
     * @param  array<int, string>  $templates
     * @param  array{name: string, region: string}  $employer
     */
    private function describe(array $templates, string $role, array $employer, ?string $regionName = null): string
    {
        return strtr($this->random->pick($templates), [
            ':role' => $role,
            ':organisation' => $employer['name'],
            ':region' => $regionName ?? $employer['region'],
        ]);
    }

    /**
     * The local-language label of a data item, falling back to English.
     *
     * @param  array<string, mixed>  $item
     */
    private function local(array $item): string
    {
        return (string) ($item[$this->lang] ?? $item['en']);
    }

    /**
     * Which key the locale's data uses for local-language labels: the locale
     * code itself when present (e.g. 'ar'), else 'so' (the original layout).
     */
    private function detectLocalKey(): string
    {
        $sample = $this->locale->degrees()[0] ?? [];
        $code = $this->locale->locale();

        return match (true) {
            isset($sample[$code]) => $code,
            isset($sample['so']) => 'so',
            default => 'en',
        };
    }

    /**
     * Native language always; every other language by its odds (region
     * overrides applied), with postgraduates likelier to speak the boosted ones.
     *
     * @param  Collection<int, EducationEntry>  $education
     * @return array<int, string>
     */
    private function buildLanguages(Collection $education, string $region): array
    {
        $odds = $this->profile->languages($region);

        $hasPostgrad = $education->contains(fn (EducationEntry $e) => str_contains(strtolower($e->degree), 'master')
            || str_contains(strtolower($e->degree), 'doctor'));
        if ($hasPostgrad) {
            foreach ($this->profile->postgraduateLanguages() as $language => $p) {
                $odds[$language] = max($odds[$language] ?? 0.0, $p);
            }
        }

        $languages = [];
        foreach ($odds as $language => $p) {
            if ($languages === [] || $this->random->bool($p)) {
                $languages[] = $language;
            }
        }

        return $languages;
    }

    private function ageFromYear(int $birthYear, int $currentYear): int
    {
        return $currentYear - $birthYear;
    }
}
