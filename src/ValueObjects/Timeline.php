<?php

namespace PersonaGenerator\ValueObjects;

use DateTimeImmutable;
use Illuminate\Support\Collection;

/**
 * The coherent structured backbone of a persona, produced by TimelineBuilder.
 *
 * @phpstan-type EducationCollection Collection<int, EducationEntry>
 * @phpstan-type EmploymentCollection Collection<int, EmploymentEntry>
 */
readonly class Timeline
{
    /**
     * @param  Collection<int, EducationEntry>  $education
     * @param  Collection<int, EmploymentEntry>  $employment
     * @param  array<int, string>  $languages
     */
    public function __construct(
        public DateTimeImmutable $dob,
        public int $age,
        public Collection $education,
        public Collection $employment,
        public array $languages,
        public string $region,
        public string $city,
    ) {}
}
