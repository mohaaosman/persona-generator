<?php

namespace PersonaGenerator;

use Closure;
use PersonaGenerator\Contracts\LocaleRepository;
use PersonaGenerator\Contracts\ProseDriver;
use PersonaGenerator\Support\NameEngine;
use PersonaGenerator\Support\SeededRandom;
use PersonaGenerator\Support\TimelineBuilder;
use PersonaGenerator\ValueObjects\Gender;

/**
 * The Faker-like entry point. Fluently configure a locale and seed, then build
 * personas. A seeded factory is fully reproducible: the Nth persona from a given
 * seed is always identical (structured fields).
 *
 * Usage:
 *   $persona  = PersonaFactory::new()->locale('so')->seed(1234)->make();
 *   $personas = PersonaFactory::new()->seed(1)->makeMany(8);
 */
class PersonaFactory
{
    private ?int $seed = null;

    private ?SeededRandom $random = null;

    private ?Gender $genderOverride = null;

    /**
     * @param  Closure(LocaleRepository): ProseDriver  $proseFactory
     */
    public function __construct(
        private LocaleRepository $locale,
        private readonly Closure $proseFactory,
    ) {}

    /**
     * Resolve a fresh factory from the service container.
     */
    public static function new(): self
    {
        return app(self::class);
    }

    public function locale(string $locale): static
    {
        $this->locale = $this->locale->withLocale($locale);

        return $this;
    }

    public function seed(int $seed): static
    {
        $this->seed = $seed;
        $this->random = null;

        return $this;
    }

    public function gender(?Gender $gender): static
    {
        $this->genderOverride = $gender;

        return $this;
    }

    public function make(): Persona
    {
        $random = $this->random();

        $gender = $this->genderOverride ?? $random->pick([Gender::Male, Gender::Female]);
        $name = (new NameEngine($this->locale, $random))->compose($gender);
        $timeline = (new TimelineBuilder($this->locale, $random))->build();
        $fingerprint = $random->int(1, PHP_INT_MAX);

        return new Persona(
            first_name: $name['first'],
            middle_name: $name['middle'],
            last_name: $name['last'],
            full_name: $name['full'],
            gender: $gender,
            age: $timeline->age,
            dob: $timeline->dob,
            fingerprint: $fingerprint,
            timeline: $timeline,
            prose: ($this->proseFactory)($this->locale),
        );
    }

    /**
     * @return array<int, Persona>
     */
    public function makeMany(int $count): array
    {
        $personas = [];
        for ($i = 0; $i < $count; $i++) {
            $personas[] = $this->make();
        }

        return $personas;
    }

    private function random(): SeededRandom
    {
        return $this->random ??= new SeededRandom($this->seed);
    }
}
