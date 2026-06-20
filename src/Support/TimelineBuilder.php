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

    public function __construct(
        private readonly LocaleRepository $locale,
        private readonly SeededRandom $random,
    ) {}

    public function build(): Timeline
    {
        $now = CarbonImmutable::now();
        $currentYear = (int) $now->format('Y');

        $targetAge = $this->random->int(self::MIN_AGE, self::MAX_AGE);
        $dob = $now->subYears($targetAge)->subDays($this->random->int(0, 364))->startOfDay();
        $age = (int) $dob->diffInYears($now);
        $birthYear = (int) $dob->format('Y');

        [$region, $city] = $this->pickHome();

        $field = $this->random->pick($this->locale->fields());
        $family = $field['family'] ?? self::DEFAULT_FAMILY;
        $education = $this->buildEducation($birthYear, $currentYear, $field);
        $bachelorEndYear = $education->first()->endYear;

        $employment = $this->buildEmployment($bachelorEndYear, $now, $family);
        $languages = $this->buildLanguages($education);

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
     * @param  array{en: string, so: string}  $field
     * @return Collection<int, EducationEntry>
     */
    private function buildEducation(int $birthYear, int $currentYear, array $field): Collection
    {
        $degrees = collect($this->locale->degrees());
        $byLevel = fn (string $level) => $this->random->pick(
            $degrees->where('level', $level)->values()->all()
        );

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
        ))->values();
    }

    /**
     * @param  array{level: string, en: string, so: string}  $degree
     * @param  array{en: string, so: string}  $field
     */
    private function makeEducation(array $degree, array $field, int $startYear, int $endYear): EducationEntry
    {
        $universities = $this->locale->universities();
        $institution = $this->random->pick(array_keys($universities));

        return new EducationEntry(
            degree: $degree['en'],
            degreeSo: $degree['so'],
            field: $field['en'],
            fieldSo: $field['so'],
            institution: $institution,
            country: $universities[$institution],
            startYear: $startYear,
            endYear: $endYear,
            isHighest: false,
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
            $employer = $this->pickEmployer();
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
                roleSo: $role['so'],
                organisation: $employer['name'],
                grade: $grade,
                region: $employer['region'],
                startDate: $start,
                endDate: $end,
                isCurrent: $isCurrent,
                description: $this->describe($descriptions['en'], $role['en'], $employer),
                descriptionSo: $this->describe($descriptions['so'], $role['so'], $employer),
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
     * Pick an employer, weighting selection toward the public sector.
     *
     * @return array{name: string, sector: string, region: string}
     */
    private function pickEmployer(): array
    {
        $bySector = [];
        foreach ($this->locale->employers() as $employer) {
            $bySector[$employer['sector'] ?? 'government'][] = $employer;
        }

        $weights = [];
        foreach (self::SECTOR_WEIGHTS as $sector => $weight) {
            if (! empty($bySector[$sector])) {
                $weights[$sector] = $weight;
            }
        }

        $sector = $weights === [] ? array_key_first($bySector) : $this->random->weightedKey($weights);

        return $this->random->pick($bySector[$sector]);
    }

    /**
     * @return array{en: array<int, string>, so: array<int, string>}
     */
    private function descriptionTemplates(): array
    {
        $templates = $this->locale->templates()['employment_description'] ?? [];

        return [
            'en' => $templates['en'] ?? ['Served as :role at :organisation in :region.'],
            'so' => $templates['so'] ?? ['Jagada :role ee :organisation, gobolka :region.'],
        ];
    }

    /**
     * @param  array<int, string>  $templates
     * @param  array{name: string, region: string}  $employer
     */
    private function describe(array $templates, string $role, array $employer): string
    {
        return strtr($this->random->pick($templates), [
            ':role' => $role,
            ':organisation' => $employer['name'],
            ':region' => $employer['region'],
        ]);
    }

    /**
     * @param  Collection<int, EducationEntry>  $education
     * @return array<int, string>
     */
    private function buildLanguages(Collection $education): array
    {
        $available = $this->locale->languages();
        $languages = ['Somali'];

        if (in_array('Arabic', $available, true) && $this->random->bool(0.7)) {
            $languages[] = 'Arabic';
        }

        $hasPostgrad = $education->contains(fn (EducationEntry $e) => str_contains(strtolower($e->degree), 'master')
            || str_contains(strtolower($e->degree), 'doctor'));
        $englishProb = $hasPostgrad ? 0.9 : 0.6;
        if (in_array('English', $available, true) && $this->random->bool($englishProb)) {
            $languages[] = 'English';
        }

        if (in_array('Italian', $available, true) && $this->random->bool(0.1)) {
            $languages[] = 'Italian';
        }

        if (in_array('Swahili', $available, true) && $this->random->bool(0.15)) {
            $languages[] = 'Swahili';
        }

        return array_values(array_unique($languages));
    }

    private function ageFromYear(int $birthYear, int $currentYear): int
    {
        return $currentYear - $birthYear;
    }
}
