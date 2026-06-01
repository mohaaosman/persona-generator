<?php

namespace PersonaGenerator\ValueObjects;

use DateTimeImmutable;

/**
 * One position in a persona's work timeline. A null endDate together with
 * isCurrent === true marks the present role.
 */
readonly class EmploymentEntry
{
    public function __construct(
        public string $role,
        public string $roleSo,
        public string $organisation,
        public string $grade,
        public string $region,
        public DateTimeImmutable $startDate,
        public ?DateTimeImmutable $endDate,
        public bool $isCurrent,
        public string $description,
        public string $descriptionSo,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'role' => $this->role,
            'role_so' => $this->roleSo,
            'organisation' => $this->organisation,
            'grade' => $this->grade,
            'region' => $this->region,
            'start_date' => $this->startDate->format('Y-m-d'),
            'end_date' => $this->endDate?->format('Y-m-d'),
            'is_current' => $this->isCurrent,
            'description' => $this->description,
            'description_so' => $this->descriptionSo,
        ];
    }
}
