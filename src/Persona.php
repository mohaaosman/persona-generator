<?php

namespace PersonaGenerator;

use Carbon\CarbonImmutable;
use DateTimeImmutable;
use Illuminate\Support\Collection;
use PersonaGenerator\Contracts\ProseDriver;
use PersonaGenerator\ValueObjects\EducationEntry;
use PersonaGenerator\ValueObjects\EmploymentEntry;
use PersonaGenerator\ValueObjects\Gender;
use PersonaGenerator\ValueObjects\Timeline;

/**
 * A generated person. Structured fields are immutable; prose (bio, cover letter)
 * is produced lazily by the ProseDriver and memoised so it is computed once.
 */
class Persona
{
    private ?string $bio = null;

    private ?string $coverLetter = null;

    public function __construct(
        public readonly string $first_name,
        public readonly string $middle_name,
        public readonly string $last_name,
        public readonly string $full_name,
        public readonly Gender $gender,
        public readonly int $age,
        public readonly DateTimeImmutable $dob,
        public readonly int $fingerprint,
        private readonly Timeline $timeline,
        private readonly ProseDriver $prose,
    ) {}

    /**
     * Education timeline, ordered oldest to newest.
     *
     * @return Collection<int, EducationEntry>
     */
    public function education(): Collection
    {
        return $this->timeline->education;
    }

    /**
     * Work timeline, ordered oldest to newest (exactly one entry is current).
     *
     * @return Collection<int, EmploymentEntry>
     */
    public function workExperience(): Collection
    {
        return $this->timeline->employment;
    }

    /**
     * @return array<int, string>
     */
    public function spokenLanguages(): array
    {
        return $this->timeline->languages;
    }

    public function region(): string
    {
        return $this->timeline->region;
    }

    public function city(): string
    {
        return $this->timeline->city;
    }

    public function highestEducation(): ?EducationEntry
    {
        return $this->education()->first(fn (EducationEntry $e) => $e->isHighest)
            ?? $this->education()->last();
    }

    public function currentEmployment(): ?EmploymentEntry
    {
        return $this->workExperience()->first(fn (EmploymentEntry $e) => $e->isCurrent)
            ?? $this->workExperience()->last();
    }

    /**
     * Professional headline, derived from the current/most-recent role.
     */
    public function headline(): string
    {
        return $this->currentEmployment()?->role ?? ($this->highestEducation()?->field ?? 'Professional');
    }

    /**
     * Full years since the first job started.
     */
    public function yearsOfExperience(): int
    {
        $first = $this->workExperience()->first();

        if ($first === null) {
            return 0;
        }

        return (int) CarbonImmutable::instance($first->startDate)->diffInYears(CarbonImmutable::now());
    }

    public function genderCode(): string
    {
        return $this->gender->code();
    }

    public function bio(): string
    {
        return $this->bio ??= $this->prose->bio($this);
    }

    public function coverLetter(): string
    {
        return $this->coverLetter ??= $this->prose->coverLetter($this);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'gender' => $this->gender->value,
            'gender_code' => $this->genderCode(),
            'age' => $this->age,
            'dob' => $this->dob->format('Y-m-d'),
            'region' => $this->region(),
            'city' => $this->city(),
            'languages' => $this->spokenLanguages(),
            'education' => $this->education()->map(fn (EducationEntry $e) => $e->toArray())->all(),
            'work_experience' => $this->workExperience()->map(fn (EmploymentEntry $e) => $e->toArray())->all(),
        ];
    }
}
