<?php

use PersonaGenerator\Persona;
use PersonaGenerator\PersonaFactory;
use PersonaGenerator\ValueObjects\EducationEntry;
use PersonaGenerator\ValueObjects\EmploymentEntry;
use PersonaGenerator\ValueObjects\Gender;

it('resolves from the container and builds a persona', function (): void {
    $persona = PersonaFactory::new()->seed(1234)->make();

    expect($persona)->toBeInstanceOf(Persona::class)
        ->and($persona->full_name)->toBe(
            "{$persona->first_name} {$persona->middle_name} {$persona->last_name}"
        );
});

it('reproduces identical structured output for the same seed', function (): void {
    $a = PersonaFactory::new()->seed(99)->make();
    $b = PersonaFactory::new()->seed(99)->make();

    expect($a->toArray())->toBe($b->toArray());
});

it('keeps the Nth persona of makeMany stable per index', function (): void {
    $first = PersonaFactory::new()->seed(7)->makeMany(5);
    $second = PersonaFactory::new()->seed(7)->makeMany(5);

    foreach ($first as $i => $persona) {
        expect($persona->toArray())->toBe($second[$i]->toArray());
    }
});

it('honours a forced gender and maps the gender code', function (): void {
    $female = PersonaFactory::new()->seed(3)->gender(Gender::Female)->make();
    $male = PersonaFactory::new()->seed(3)->gender(Gender::Male)->make();

    expect($female->gender)->toBe(Gender::Female)
        ->and($female->genderCode())->toBe('F')
        ->and($male->gender)->toBe(Gender::Male)
        ->and($male->genderCode())->toBe('M');
});

it('keeps age within the documented range and consistent with dob', function (): void {
    foreach (PersonaFactory::new()->seed(11)->makeMany(25) as $persona) {
        expect($persona->age)->toBeGreaterThanOrEqual(24)
            ->and($persona->age)->toBeLessThanOrEqual(59);

        $derivedAge = (int) $persona->dob->diff(new DateTimeImmutable('today'))->y;
        expect($derivedAge)->toBe($persona->age);
    }
});

it('produces a chronological education timeline with exactly one highest degree', function (): void {
    foreach (PersonaFactory::new()->seed(21)->makeMany(25) as $persona) {
        $education = $persona->education();

        expect($education)->not->toBeEmpty()
            ->and($education->where('isHighest', true))->toHaveCount(1);

        $thisYear = (int) date('Y');
        $previousEnd = 0;

        $education->each(function (EducationEntry $entry) use (&$previousEnd, $thisYear): void {
            expect($entry->startYear)->toBeLessThanOrEqual($entry->endYear)
                ->and($entry->endYear)->toBeLessThanOrEqual($thisYear)
                ->and($entry->startYear)->toBeGreaterThanOrEqual($previousEnd);
            $previousEnd = $entry->startYear;
        });
    }
});

it('builds an ordered, non-overlapping employment timeline with exactly one current role', function (): void {
    foreach (PersonaFactory::new()->seed(31)->makeMany(25) as $persona) {
        $employment = $persona->workExperience();

        expect($employment)->not->toBeEmpty()
            ->and($employment->where('isCurrent', true))->toHaveCount(1);

        $current = $employment->firstWhere('isCurrent', true);
        expect($current->endDate)->toBeNull();

        $previousEnd = null;
        $employment->each(function (EmploymentEntry $entry) use (&$previousEnd): void {
            expect($entry->endDate === null || $entry->startDate <= $entry->endDate)->toBeTrue();

            if ($previousEnd !== null) {
                expect($entry->startDate >= $previousEnd)->toBeTrue();
            }

            $previousEnd = $entry->endDate ?? $entry->startDate;
        });
    }
});

it('starts the first job no earlier than the bachelor graduation', function (): void {
    foreach (PersonaFactory::new()->seed(41)->makeMany(25) as $persona) {
        $firstJob = $persona->workExperience()->first();
        $earliestGraduation = $persona->education()->min('endYear');

        expect((int) $firstJob->startDate->format('Y'))
            ->toBeGreaterThanOrEqual($earliestGraduation);
    }
});

it('aligns every job role with the field of study career family', function (): void {
    $dir = __DIR__.'/../../resources/lang/so';
    $familyByField = collect(require "{$dir}/fields.php")
        ->mapWithKeys(fn (array $f) => [$f['en'] => $f['family']]);

    // role label -> set of families that contain it
    $familiesByRole = [];
    foreach (require "{$dir}/job_titles.php" as $family => $tiers) {
        foreach ($tiers as $roles) {
            foreach ($roles as $role) {
                $familiesByRole[$role['en']][$family] = true;
            }
        }
    }

    foreach (PersonaFactory::new()->seed(202)->makeMany(40) as $persona) {
        $field = $persona->education()->first()->field;
        $family = $familyByField[$field];

        $persona->workExperience()->each(function (EmploymentEntry $entry) use ($family, $familiesByRole): void {
            expect($familiesByRole)->toHaveKey($entry->role);
            expect($familiesByRole[$entry->role])->toHaveKey($family);
        });
    }
});

it('draws employers from multiple sectors with the public sector dominant', function (): void {
    $sectorByOrg = collect(require __DIR__.'/../../resources/lang/so/employers.php')
        ->mapWithKeys(fn (array $e) => [$e['name'] => $e['sector']]);

    $counts = ['government' => 0, 'ngo' => 0, 'private' => 0];
    foreach (PersonaFactory::new()->seed(303)->makeMany(80) as $persona) {
        $persona->workExperience()->each(function (EmploymentEntry $entry) use ($sectorByOrg, &$counts): void {
            $counts[$sectorByOrg[$entry->organisation]]++;
        });
    }

    expect(collect($counts)->filter()->count())->toBeGreaterThan(1);
    expect($counts['government'])->toBeGreaterThan($counts['ngo'])
        ->and($counts['government'])->toBeGreaterThan($counts['private']);
});

it('produces occasional career gaps while preserving timeline order', function (): void {
    $sawGap = false;

    foreach (PersonaFactory::new()->seed(404)->makeMany(80) as $persona) {
        $positions = $persona->workExperience()->values();

        for ($i = 0; $i < $positions->count() - 1; $i++) {
            $end = $positions[$i]->endDate;
            $next = $positions[$i + 1]->startDate;
            expect($next >= $end)->toBeTrue();

            $months = $end->diff($next)->y * 12 + $end->diff($next)->m;
            if ($months >= 6) {
                $sawGap = true;
            }
        }
    }

    expect($sawGap)->toBeTrue();
});

it('always lists Somali among spoken languages', function (): void {
    foreach (PersonaFactory::new()->seed(51)->makeMany(25) as $persona) {
        expect($persona->spokenLanguages())->toContain('Somali');
    }
});

it('exposes a full structured array', function (): void {
    $persona = PersonaFactory::new()->seed(61)->make();

    expect($persona->toArray())
        ->toHaveKeys([
            'first_name', 'middle_name', 'last_name', 'full_name',
            'gender', 'gender_code', 'age', 'dob', 'region', 'city',
            'languages', 'education', 'work_experience',
        ]);
});

it('falls back to deterministic template prose by default', function (): void {
    $a = PersonaFactory::new()->seed(71)->make();
    $b = PersonaFactory::new()->seed(71)->make();

    expect($a->bio())->toBeString()->not->toBeEmpty()
        ->and($a->coverLetter())->toBeString()->not->toBeEmpty()
        ->and($a->bio())->toBe($b->bio())
        ->and($a->coverLetter())->toBe($b->coverLetter());
});
