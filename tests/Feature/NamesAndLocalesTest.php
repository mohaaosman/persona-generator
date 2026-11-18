<?php

use PersonaGenerator\PersonaFactory;
use PersonaGenerator\ValueObjects\EmploymentEntry;
use PersonaGenerator\ValueObjects\Gender;

dataset('locales', ['so', 'ar']);

function localeData(string $locale, string $file): array
{
    return require __DIR__."/../../resources/lang/{$locale}/{$file}.php";
}

it('ships unique, disjoint, single-word given-name pools', function (string $locale): void {
    $male = localeData($locale, 'male_first_names');
    $female = localeData($locale, 'female_first_names');

    expect(count($male))->toBeGreaterThan(400)
        ->and(count($female))->toBeGreaterThan(280)
        ->and($male)->toBe(array_values(array_unique($male)))
        ->and($female)->toBe(array_values(array_unique($female)))
        ->and(array_intersect($male, $female))->toBeEmpty();

    // One given name per entry: a space or hyphen would smuggle in a father's name.
    foreach ([...$male, ...$female] as $name) {
        expect($name)->not->toMatch('/[\s-]/');
    }
})->with('locales');

it('builds patronymic names: own name, then father and grandfather from the male pool', function (string $locale): void {
    $male = localeData($locale, 'male_first_names');
    $female = localeData($locale, 'female_first_names');

    foreach (PersonaFactory::new()->locale($locale)->seed(808)->makeMany(60) as $persona) {
        $own = $persona->gender === Gender::Female ? $female : $male;

        expect($own)->toContain($persona->first_name)
            ->and($male)->toContain($persona->fatherName())
            ->and($male)->toContain($persona->grandfatherName())
            ->and($persona->fatherName())->not->toBe($persona->grandfatherName())
            ->and($persona->fatherName())->not->toBe($persona->first_name)
            ->and($persona->full_name)->toBe("{$persona->first_name} {$persona->fatherName()} {$persona->grandfatherName()}")
            ->and($persona->fatherFullName())->toBe("{$persona->middle_name} {$persona->last_name}");
    }
})->with('locales');

it('keeps the timeline invariants in every locale', function (string $locale): void {
    foreach (PersonaFactory::new()->locale($locale)->seed(909)->makeMany(40) as $persona) {
        expect($persona->workExperience()->where('isCurrent', true))->toHaveCount(1)
            ->and($persona->education()->where('isHighest', true))->toHaveCount(1)
            ->and($persona->age)->toBeGreaterThanOrEqual(24);
    }
})->with('locales');

it('speaks the native language of the locale first', function (string $locale, string $native): void {
    foreach (PersonaFactory::new()->locale($locale)->seed(51)->makeMany(25) as $persona) {
        expect($persona->spokenLanguages()[0])->toBe($native);
    }
})->with([['so', 'Somali'], ['ar', 'Arabic']]);

it('gives each persona realistic contact and civil details', function (string $locale): void {
    $profile = localeData($locale, 'profile');

    foreach (PersonaFactory::new()->locale($locale)->seed(1001)->makeMany(40) as $persona) {
        $region = $profile['regions'][$persona->region()] ?? [];
        $patterns = $region['phone'] ?? $profile['phone'];
        $regexes = array_map(fn ($p) => '/^'.str_replace(['\#', '\+'], ['\d', '\+'], preg_quote($p, '/')).'$/', $patterns);

        expect(collect($regexes)->contains(fn ($re) => preg_match($re, $persona->phone) === 1))->toBeTrue()
            ->and($persona->email)->toMatch('/^[a-z0-9._]+@[a-z.]+$/')
            ->and($persona->marital_status)->toBeIn(['single', 'married', 'divorced', 'widowed'])
            ->and($persona->nationality)->not->toBeEmpty()
            ->and($persona->toArray())->toHaveKeys(['father_name', 'grandfather_name', 'nationality', 'country', 'phone', 'email', 'marital_status']);
    }
})->with('locales');

it('localises bilingual labels and keys them by locale', function (): void {
    $persona = PersonaFactory::new()->locale('ar')->seed(77)->make();
    $array = $persona->toArray();

    expect($array['education'][0])->toHaveKeys(['degree_ar', 'field_ar'])
        ->and($array['work_experience'][0])->toHaveKeys(['role_ar', 'description_ar'])
        ->and($array['work_experience'][0]['role_ar'])->toMatch('/\p{Arabic}/u');

    expect(PersonaFactory::new()->locale('so')->seed(77)->make()->toArray()['education'][0])
        ->toHaveKey('degree_so');
});

it('only places Arab personas in their own country\'s civil service', function (): void {
    $employers = collect(localeData('ar', 'employers'))->keyBy('name');

    foreach (PersonaFactory::new()->locale('ar')->seed(1212)->makeMany(60) as $persona) {
        $persona->workExperience()->each(function (EmploymentEntry $job) use ($employers, $persona): void {
            if ($employers[$job->organisation]['sector'] === 'government') {
                expect($job->region)->toBe($persona->region());
            }
        });
    }
});

it('only employs people at organisations that hire their career family', function (string $locale): void {
    $employers = collect(localeData($locale, 'employers'))->keyBy('name');
    $familyByField = collect(localeData($locale, 'fields'))->mapWithKeys(fn ($f) => [$f['en'] => $f['family']]);

    foreach (PersonaFactory::new()->locale($locale)->seed(1313)->makeMany(60) as $persona) {
        $family = $familyByField[$persona->education()->first()->field];

        $persona->workExperience()->each(function (EmploymentEntry $job) use ($employers, $family): void {
            $hires = $employers[$job->organisation]['families'] ?? null;
            expect($hires === null || in_array($family, $hires, true))->toBeTrue();
        });
    }
})->with('locales');
