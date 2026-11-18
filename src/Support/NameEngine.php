<?php

namespace PersonaGenerator\Support;

use PersonaGenerator\Contracts\LocaleRepository;
use PersonaGenerator\ValueObjects\Gender;

/**
 * Composes names using the patronymic convention shared by Somali and many
 * Arab naming traditions — there is no family name / surname:
 *   - first name  : the person's own given name, from the gendered pool
 *   - middle name : father's given name      -> always the MALE pool
 *   - last name   : grandfather's given name -> always the MALE pool
 *
 * A son is not given his father's own name, and a father and grandfather
 * differ; a boy named after his grandfather (Cali Maxamed Cali) is common and
 * allowed.
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
        $guard = 0;
        while ($middle === $first && count($maleNames) > 1 && $guard < 10) {
            $middle = $this->random->pick($maleNames);
            $guard++;
        }

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
