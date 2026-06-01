# Changelog

## [0.2.0] - 2026-06-01

### Changed

- Broadened compatibility so the package can be used by **Laravel 11+** apps:
  `php` floor lowered to `^8.2`, `illuminate/support` and
  `illuminate/collections` widened to `^11 || ^12 || ^13`, and `nesbot/carbon`
  to `^2.72 || ^3.0`.
- Allowed Pest `^3 || ^4` as a dev dependency.

### Added

- Standalone test harness: `phpunit.xml`, Orchestra Testbench `TestCase`, Pest
  bootstrap, and feature/unit tests covering determinism, the coherence
  invariants (age/dob agreement, chronological education with one highest degree,
  ordered non-overlapping employment with one current role, first job ≥ bachelor
  graduation, Somali always present), gender override, and template-prose
  fallback (16 tests, 713 assertions).
- `composer test` script, package `.gitignore`, and `config.allow-plugins`
  for the Pest plugin.
- Laravel Boost maintainer skill at
  `resources/boost/skills/persona-generator/SKILL.md` — Boost's SkillComposer
  auto-loads its directives when the agent's prompt mentions `PersonaFactory`,
  persona seeding, or candidate seeders.

### Notes

- PSR-4 autoloaded (`PersonaGenerator\`) and PSR-12 formatted via Pint.
- No source behaviour changed; the package remains extractable to its own repo
  / Packagist without code changes.

## [0.1.0] - 2026-06-01

### Added

- Initial release.
- `PersonaFactory` with fluent `locale()`, `seed()`, `gender()`, `make()`, `makeMany()`.
- `Persona` value object: names, gender, age/dob, `education()`, `workExperience()`,
  `spokenLanguages()`, `region()`/`city()`, `headline()`, `yearsOfExperience()`,
  `bio()`, `coverLetter()`, `toArray()`.
- `NameEngine` — Somali patronymic name composition (gendered first name; male
  middle & last names).
- `TimelineBuilder` — coherent dob → education → employment timeline with
  enforced invariants.
- `SeededRandom` — isolated, reproducible randomness via `\Random\Randomizer`.
- `ArrayLocaleRepository` + bundled `so` (Somali) data set.
- Prose drivers: `TemplateProseDriver` (offline, deterministic) and
  `AiProseDriver` (`laravel/ai`, opt-in, template fallback).
- `PersonaGeneratorServiceProvider` with publishable config and data.
