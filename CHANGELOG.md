# Changelog

All notable changes to `mohaaosman/persona-generator` are documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

> Versioning note: this standalone package restarted at `v0.0.1` on extraction.
> Earlier in-app `0.1.0`/`0.2.0` history was folded into `v0.0.1` below.

## [Unreleased]

### Arab locale, cleaner names & fuller human profiles

#### Added
- **`ar` (pan-Arab) locale** — 447 male / 289 female Arabic given names in
  common English transliteration, 12 Arab countries as home regions (Saudi
  Arabia, UAE, Qatar, Kuwait, Oman, Bahrain, Jordan, Egypt, Sudan, Morocco,
  Iraq, Yemen), with real universities, employers, Arabic degree/field/role
  labels and Arabic employment descriptions. Same patronymic rule: own name +
  father + grandfather, no family names.
- **Fuller profiles** on every persona: `nationality`, `country`,
  `marital_status` (age-weighted), `phone` (home-country mobile format; Somali
  operator prefix follows the region) and `email` (derived from the persona's
  own name). Also `fatherName()`, `grandfatherName()`, `fatherFullName()`, and
  `father_name` / `grandfather_name` in `toArray()`.
- **`profile.php`** locale file (+ `LocaleRepository::profile()`) for
  nationality, phone patterns, e-mail domains, language odds and per-region
  overrides.
- Employers may declare the career `families` they hire and degrees the
  `families` they suit; new degrees: Bachelor/Master of Laws, Master of Arts.

#### Changed
- **Somali name pools rebuilt**: 423 male / 286 female, all real given names in
  Somali orthography. Removed titles (Sheekh, Xaaji, Macalin, Ugaas), places and
  regions (Lasanod, Hiiraan), common nouns (Hooyo, Madaxweyne, Xildhibaan),
  mis-gendered entries, English spellings mixed into Somali ones, and
  "first + father" composites such as *Shukri Maxamed* that broke the
  three-part name.
- A son is never given his father's own name (grandfather's name is allowed).
- Spoken languages are locale-driven: the first entry of `languages.php` (now
  `[language => probability]`, plain lists still accepted) is the native
  language; Somali is no longer hard-coded.
- Careers are grounded: ~80% of degrees from home-country universities, most
  jobs in the home region, employers matched to the career family, and (in
  `ar`) government posts only in the persona's own country.
- Local-language keys in `toArray()` follow the locale (`role_so`, `role_ar`,
  …); entries carry a `lang` property.

### v0.1.0 — expanded names & richer personas (pending tag)

> **Breaking (seed reproducibility):** the persona produced for a given seed
> differs from v0.0.x. This is intentional — generation logic and data pools
> changed substantially. Reproducibility is guaranteed *within* v0.1.x, not
> across the v0.0.x → v0.1.0 boundary.

#### Added
- **Field-aligned careers.** Each field of study now maps to a career *family*
  (one of: public administration, finance, business, law, engineering, ICT,
  health, education, agriculture, social/development). A persona's job ladder is
  drawn from that family, so an Engineering graduate holds engineering roles —
  not unrelated finance ones. `job_titles.php` is now keyed `family → tier → roles`.
- **Sector variety.** Employers carry a `sector` (`government` / `ngo` /
  `private`); selection is weighted public-sector-first (~60 / 30 / 15).
- **Occasional career gaps.** ~30% of personas have one short gap (≈6–20 months)
  between two positions. The one-current-position and no-overlap invariants still
  hold.
- **Varied prose.** Bilingual, gender-neutral employment-description templates
  (replacing the single hardcoded sentence) plus more bio and cover-letter
  variants, so a batch of personas reads less repetitively.
- New tests covering field/role alignment, sector distribution, and career gaps.

#### Changed
- Name pools expanded: male **125 → 404**, female **83 → 265** (authentic Somali
  given names; pools verified unique and disjoint).
- Supporting pools grown: fields **16 → 41**, employers **20 → 54**,
  universities **19 → 37**.
- `LocaleRepository::fields()`, `employers()`, and `jobTitles()` now return the
  enriched shapes (`family` on fields, `sector` on employers, family-keyed job
  titles). Custom `LocaleRepository` implementations and published data must
  follow suit.

#### Fixed
- Somali employment descriptions are no longer hardcoded with a male subject
  pronoun (`Wuxuu …`); the new templates are gender-neutral.

## [0.0.3] - 2026-06-20

### Changed
- Bumped the optional `laravel/ai` prose-driver dependency to `^0.8` (was `^0.6`).
  The `agent()`/`prompt()` API is unchanged across 0.6 → 0.8, so `AiProseDriver`
  required no code changes; it still falls back to the offline template driver on
  any failure.
- Resolved `nesbot/carbon` to `3.13` and `pestphp/pest` to `4.7.3` within the
  existing constraints.

### Fixed
- Removed `Liibaan` (a male given name) from the female first-name pool.
- De-duplicated the male first-name pool — `Yuusuf`, `Maxamuud`, `Cabdiraxmaan`,
  `Cabdulaahi`, and `Xirsi` each appeared twice. Orthographic variants
  (e.g. `Cabdullaahi`/`Cabdulahi`, `Hirsi`/`Xirsi`) are retained intentionally.

## [0.0.2] - 2026-06-01

### Changed
- Renamed the package vendor to `mohaaosman/persona-generator`.
- Required PHP `^8.3` to match the `laravel/ai` dev dependency.

### Added
- CI test-matrix workflow and Packagist auto-update on release.

## [0.0.1] - 2026-06-01

### Added
- `PersonaFactory` with fluent `locale()`, `seed()`, `gender()`, `make()`,
  `makeMany()`.
- `Persona` value object: names, gender, age/dob, `education()`,
  `workExperience()`, `spokenLanguages()`, `region()`/`city()`, `headline()`,
  `yearsOfExperience()`, `bio()`, `coverLetter()`, `toArray()`.
- `NameEngine` — Somali patronymic name composition (gendered first name; male
  middle & last names).
- `TimelineBuilder` — coherent dob → education → employment timeline with enforced
  invariants (age/dob agreement, chronological education with one highest degree,
  ordered non-overlapping employment with one current role, first job ≥ bachelor
  graduation, Somali always present).
- `SeededRandom` — isolated, reproducible randomness via `\Random\Randomizer`.
- `ArrayLocaleRepository` + bundled `so` (Somali) data set.
- Prose drivers: `TemplateProseDriver` (offline, deterministic) and `AiProseDriver`
  (`laravel/ai`, opt-in, template fallback).
- `PersonaGeneratorServiceProvider` with publishable config and data.
- Standalone test harness (`phpunit.xml`, Orchestra Testbench `TestCase`, Pest
  bootstrap) with feature/unit coverage of determinism and the coherence
  invariants (16 tests).
- Laravel Boost maintainer skill at
  `resources/boost/skills/persona-generator/SKILL.md`.

### Notes
- Compatible with **Laravel 11, 12, and 13** (`illuminate/*: ^11 || ^12 || ^13`,
  `nesbot/carbon: ^2.72 || ^3.0`); Pest `^3 || ^4` as a dev dependency.
- PSR-4 autoloaded (`PersonaGenerator\`) and PSR-12 formatted via Pint.
