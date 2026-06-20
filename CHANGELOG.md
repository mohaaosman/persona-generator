# Changelog

All notable changes to `mohaaosman/persona-generator` are documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

> Versioning note: this standalone package restarted at `v0.0.1` on extraction.
> Earlier in-app `0.1.0`/`0.2.0` history was folded into `v0.0.1` below.

## [Unreleased]

Planned for **v0.1.0** — expanded Somali name pools and richer persona generation
(field-aligned career families, sector variety, occasional career gaps, varied
prose, larger supporting pools). This will intentionally change the persona
produced for a given seed; reproducibility is guaranteed *within* a minor
version, not across it.

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
