# PersonaGenerator

A Faker-like generator for **realistic, internally-coherent, seedable** person
personas — names, gender, age/dob, education & work timelines, spoken languages,
bio and cover letter. Locale-aware (ships with Somali) and Laravel-ready.

The standout feature is **patronymic naming**: a persona's first name comes from
a gendered pool, while the middle (father's) and last (grandfather's) names are
always drawn from the male pool — the way Somali names actually work — giving an
effectively unbounded pool of unique people.

## Requirements

- PHP `^8.3` (uses `\Random\Randomizer`; the optional `laravel/ai` prose driver requires 8.3+)
- Laravel **11, 12, or 13** (`illuminate/support: ^11 || ^12 || ^13`)
- `nesbot/carbon: ^2.72 || ^3.0`

PSR-4 autoloaded under the `PersonaGenerator\` namespace and PSR-12 formatted, so
it drops into any Laravel 11+ app and can be extracted to its own repo /
Packagist later without code changes.

## Install (local path package)

In the host app's `composer.json`:

```jsonc
"repositories": [
    { "type": "path", "url": "packages/persona-generator", "options": { "symlink": true } }
],
"require": { "mohaaosman/persona-generator": "@dev" }
```

```bash
composer update mohaaosman/persona-generator
php artisan vendor:publish --tag=persona-generator-config   # optional
```

## Usage

```php
use PersonaGenerator\PersonaFactory;
use PersonaGenerator\ValueObjects\Gender;

$persona = PersonaFactory::new()->locale('so')->seed(1234)->make();

$persona->full_name;          // "Faadumo Maxamed Cabdullaahi"
$persona->genderCode();       // "F"
$persona->age;                // 31
$persona->education();        // Collection<EducationEntry>, oldest → newest
$persona->workExperience();   // Collection<EmploymentEntry>, exactly one current
$persona->spokenLanguages();  // ["Somali", "Arabic", "English"]
$persona->bio();              // memoised prose
$persona->coverLetter();      // memoised prose

PersonaFactory::new()->seed(1)->makeMany(8); // array<Persona>
```

## Guarantees

- **Coherent** — one birth year drives age, education years, and a first job that
  starts no earlier than graduation; employment is ordered and non-overlapping.
- **Seedable** — a given seed reproduces the same structured output via an
  isolated `\Random\Randomizer` (never touches global `mt_srand()`). AI prose is
  the exception and is non-deterministic.
- **Offline by default** — bio/cover letter use sentence templates; enable
  `laravel/ai` prose with `config('persona-generator.ai.enabled')` (falls back to
  templates on any failure).

## Testing

The package is self-contained: it ships its own `phpunit.xml` and an
Orchestra Testbench harness, so you can develop and test it in isolation.

```bash
cd packages/persona-generator
composer install
composer test          # or: ./vendor/bin/pest
```

## Laravel Boost skill

The package ships a Boost maintainer skill at
`resources/boost/skills/persona-generator/SKILL.md`. When the host app uses
Laravel Boost, its SkillComposer auto-discovers this skill and loads the usage
directives into the agent's context whenever the prompt mentions `PersonaFactory`,
persona seeding, or candidate seeders — no host-side wiring required.

## Adding a locale

Mirror `resources/lang/so/` for your locale and call
`PersonaFactory::new()->locale('{locale}')`. Override bundled data by publishing
`--tag=persona-generator-data` and pointing `PERSONA_DATA_PATH` at it.

See the host project's `docs/persona-generator.md` for the full reference.
