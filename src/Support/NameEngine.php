<?php

namespace PersonaGenerator\Support;

use PersonaGenerator\Contracts\LocaleRepository;
use PersonaGenerator\ValueObjects\Gender;

/**
 * Composes names using the Somali patronymic convention:
 *   - first name  : drawn from the gendered pool
 *   - middle name : father's given name      -> always the MALE pool
 *   - last name   : grandfather's given name -> always the MALE pool
 *
 * @phpstan-type ComposedName array{first: string, middle: string, last: string, full: string}
 */
class NameEngine
{
    public function __construct(
        private readonly LocaleRepository $locale,
        private readonly SeededRandom $random,
    ) {}

    /**
     * @return ComposedName
     */
    public function compose(Gender $gender): array
    {
        $maleNames = $this->locale->maleFirstNames();

        $first = $gender->isFemale()
            ? $this->random->pick($this->locale->femaleFirstNames())
            : $this->random->pick($maleNames);

        $middle = $this->random->pick($maleNames);

        // Grandfather's name should differ from the father's where the pool allows it.
        $last = $this->random->pick($maleNames);
        $guard = 0;
        while ($last === $middle && count($maleNames) > 1 && $guard < 10) {
            $last = $this->random->pick($maleNames);
            $guard++;
        }

        return [
            'first' => $first,
            'middle' => $middle,
            'last' => $last,
            'full' => "{$first} {$middle} {$last}",
        ];
    }
}
