<?php

namespace PersonaGenerator\ValueObjects;

/**
 * One degree in a persona's education timeline. Both English and local-language
 * labels are provided so consumers can populate bilingual columns directly.
 *
 * The `*So` properties hold the label in the locale's own language — Somali for
 * `so`, Arabic for `ar` — and `$lang` names that language. toArray() keys the
 * local labels by it (`degree_so`, `degree_ar`, ...).
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
        public string $lang = 'so',
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'degree' => $this->degree,
            "degree_{$this->lang}" => $this->degreeSo,
            'field' => $this->field,
            "field_{$this->lang}" => $this->fieldSo,
            'institution' => $this->institution,
            'country' => $this->country,
            'start_year' => $this->startYear,
            'end_year' => $this->endYear,
            'is_highest' => $this->isHighest,
        ];
    }
}
