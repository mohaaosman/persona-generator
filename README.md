# PersonaGenerator

A Faker-like generator for **realistic, internally-coherent, seedable** person
personas — names, gender, age/dob, education & work timelines, spoken languages,
bio and cover letter, plus the civil details that make a persona read like a
real person (nationality, marital status, phone, e-mail). Locale-aware — ships
with **Somali (`so`)** and **pan-Arab (`ar`)** locales — and Laravel-ready.

The standout feature is **patronymic naming**. Somalis (and many Arabs) do not
use family names: a full name is *own name + father's name + grandfather's
name*. A persona's first name comes from a gendered pool, while the middle
(father's) and last (grandfather's) names are always drawn from the male pool,
giving an effectively unbounded pool of unique, believable people.

| Locale | Male names | Female names | Home regions | Example |
|---|---|---|---|---|
| `so` | 423 | 286 | 18 Somali regions | *Haweeyo Cabdixalim Khaliif* (Awdal, +252 65 …) |
| `ar` | 447 | 289 | 12 Arab countries | *Fatiha Musab Nayef* (Omani, +968 …) |

Name pools contain only real given names — one per entry, no titles (Sheekh,
Xaaji), place or clan names, and no "first + father" composites.

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
$persona->fatherName();       // "Maxamed"     (the middle name)
$persona->grandfatherName();  // "Cabdullaahi" (the last name)
$persona->nationality;        // "Somali"
$persona->marital_status;     // "married" | "single" | "divorced" | "widowed"
$persona->phone;              // "+252 61 2169212" (operator prefix fits the region)
$persona->email;              // "faadumo.maxamed@gmail.com"
$persona->genderCode();       // "F"
$persona->age;                // 31
$persona->education();        // Collection<EducationEntry>, oldest → newest
$persona->workExperience();   // Collection<EmploymentEntry>, exactly one current
$persona->spokenLanguages();  // ["Somali", "Arabic", "English"]
$persona->bio();              // memoised prose
$persona->coverLetter();      // memoised prose

PersonaFactory::new()->seed(1)->makeMany(8); // array<Persona>

// Arab personas: Arabic-first languages, Arabic labels (role_ar, degree_ar, …)
$arab = PersonaFactory::new()->locale('ar')->seed(5)->make();
$arab->full_name;    // e.g. "Zeina Tahir Muhsin"
$arab->nationality;  // "Qatari"
$arab->phone;        // "+974 6850 6167"
```

## Guarantees

- **Coherent** — one birth year drives age, education years, and a first job that
  starts no earlier than graduation; employment is ordered and non-overlapping.
- **Patronymic, never surnames** — father ≠ grandfather, a son never carries his
  father's own name, and a woman keeps her father's line for life.
- **Home-grounded** — degrees are mostly from home-country universities, most
  jobs are in the home region, phone numbers follow the home country's mobile
  format, and spoken languages follow local odds (French in Morocco, Swahili in
  Lower Juba). In the `ar` locale civil-service posts go to nationals only.
- **Employers fit the job** — employers declare the career families they hire,
  so a nurse works for a health body, not the justice ministry; degrees fit the
  field too (LLB for Law, no MBA in Medicine).
- **Field-aligned careers** — each field of study maps to a career *family*
  (engineering, health, finance, ICT, law, education, …), so a persona's job
  ladder matches what they studied. Most positions are public-sector, with some
  NGO and private employers mixed in for realism. ~30% of personas show one short
  career gap.
- **Seedable** — a given seed reproduces the same structured output via an
  isolated `\Random\Randomizer` (never touches global `mt_srand()`). AI prose is
  the exception and is non-deterministic. Note: seed output is stable *within* a
  minor version; v0.1.0 intentionally changed what a given seed produces.
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

Mirror `resources/lang/so/` (or `ar/`) for your locale. Local-language labels in
the data use the locale code as their key (`'so' => …`, `'ar' => …`), and
`profile.php` holds nationality, phone patterns, e-mail domains and per-region
overrides. Then call
`PersonaFactory::new()->locale('{locale}')`. Override bundled data by publishing
`--tag=persona-generator-data` and pointing `PERSONA_DATA_PATH` at it.

See the host project's `docs/persona-generator.md` for the full reference.
