<?php

namespace PersonaGenerator\ValueObjects;

/**
 * One degree in a persona's education timeline. Both English and Somali labels
 * are provided so consumers can populate bilingual columns directly.
 */
readonly class EducationEntry
{
    public function __construct(
        public string $degree,
        public string $degreeSo,
        public string $field,
        public string $fieldSo,
        public string $institution,
        public string $country,
        public int $startYear,
        public int $endYear,
        public bool $isHighest,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'degree' => $this->degree,
            'degree_so' => $this->degreeSo,
            'field' => $this->field,
            'field_so' => $this->fieldSo,
            'institution' => $this->institution,
            'country' => $this->country,
            'start_year' => $this->startYear,
            'end_year' => $this->endYear,
            'is_highest' => $this->isHighest,
        ];
    }
}
