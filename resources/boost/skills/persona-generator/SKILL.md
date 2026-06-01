---
name: "Persona Generator Skill"
description: "Teaches the AI agent how to seed realistic, coherent, locale-aware person personas with PersonaGenerator instead of raw fake() calls."
triggers:
  - "persona-generator"
  - "PersonaGenerator"
  - "PersonaFactory"
  - "PersonaFactory::new"
  - "persona seeding"
  - "candidate seeder"
---

# Persona Generator Development Skill

You are an expert AI coding agent specializing in `PersonaGenerator` — a
Faker-like generator for realistic, internally-coherent, seedable person
personas (names, gender, age/dob, education & work timelines, spoken languages,
bio, cover letter). Use it to seed candidate-like data instead of stock
`fake()->firstName()` (which produces en_US names).

## Directives

- **Resolve from the container.** Always start with `PersonaFactory::new()`
  (it resolves the bound factory), then fluently chain `locale()`, `seed()`,
  and/or `gender()` before `make()` / `makeMany()`. Never `new PersonaFactory(...)`
  by hand — its constructor needs the injected `LocaleRepository` and prose factory.
- **Seed for reproducibility.** Pass `->seed($n)` when output must be stable. The
  Nth persona of `makeMany()` is identical per index for a given seed. The factory
  uses an isolated `\Random\Randomizer` and never calls global `mt_srand()`, so it
  is safe to interleave with the app's `fake()` sequence — it will not perturb it.
- **Map gender correctly.** Use `->genderCode()` (`'M'` / `'F'`) for columns like
  `candidate_profiles.gender`; use `->gender` (the `Gender` enum) in PHP logic.
  Force a gender only when needed via `->gender(Gender::Female)`.
- **Trust the coherence invariants — do not re-derive them.** Age (24–59) agrees
  with dob; education is chronological with exactly one `isHighest`; employment is
  ordered, non-overlapping, with exactly one current role (`endDate === null`,
  `isCurrent === true`); the first job starts no earlier than bachelor graduation;
  Somali is always in `spokenLanguages()`. Read these off the persona — never
  recompute or "fix" them in the consumer.
- **Prefer offline template prose.** `bio()` / `coverLetter()` default to the
  deterministic `TemplateProseDriver`. Only enable the AI driver via
  `config('persona-generator.ai.enabled')` (env `PERSONA_AI_PROSE=true`) when
  genuinely natural prose is required — AI prose is **non-deterministic even with a
  seed**, and any failure silently falls back to templates.
- **Locale & data overrides.** The default locale is `so` (Somali). To customise
  the source data, publish it (`vendor:publish --tag=persona-generator-data`) and
  point `PERSONA_DATA_PATH` at the copy; add a locale by mirroring
  `resources/lang/so/` and calling `->locale('{locale}')`.
- **Persist via `toArray()`.** For bulk inserts, use `->toArray()` (snake_case
  keys: `gender_code`, `dob` as `Y-m-d`, nested `education` / `work_experience`)
  rather than reading each accessor by hand.

## Code Examples

Seed a batch of coherent candidate personas inside a seeder:

```php
use PersonaGenerator\PersonaFactory;
use PersonaGenerator\ValueObjects\Gender;

$personas = PersonaFactory::new()
    ->locale('so')   // default; explicit for clarity
    ->seed(2026)     // reproducible across runs
    ->makeMany(50);

foreach ($personas as $persona) {
    CandidateProfile::create([
        'first_name'  => $persona->first_name,
        'middle_name' => $persona->middle_name,
        'last_name'   => $persona->last_name,
        'gender'      => $persona->genderCode(),   // 'M' / 'F'
        'dob'         => $persona->dob,             // DateTimeImmutable
        'region'      => $persona->region(),
        'city'        => $persona->city(),
        'headline'    => $persona->headline(),
        'bio'         => $persona->bio(),           // memoised
    ]);
}
```

Force a gender and read the structured timeline:

```php
$persona = PersonaFactory::new()->seed(7)->gender(Gender::Female)->make();

$persona->highestEducation();   // EducationEntry|null
$persona->currentEmployment();  // EmploymentEntry (endDate === null)
$persona->yearsOfExperience();  // int
$persona->toArray();            // full structured array for bulk insert
```
