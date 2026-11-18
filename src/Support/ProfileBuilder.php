<?php

namespace PersonaGenerator\Support;

use PersonaGenerator\ValueObjects\Gender;

/**
 * Builds the person-level details that make a persona read like a real
 * individual rather than a CV: nationality, marital status, a phone number in
 * the home country's mobile format and an e-mail address derived from the
 * persona's own name.
 */
class ProfileBuilder
{
    public function __construct(
        private readonly LocaleProfile $profile,
        private readonly SeededRandom $random,
    ) {}

    /**
     * @param  array{first: string, middle: string, last: string}  $name
     * @return array{country: string, nationality: string, marital_status: string, phone: string, email: string}
     */
    public function build(array $name, Gender $gender, int $age, string $region): array
    {
        return [
            'country' => $this->profile->country($region),
            'nationality' => $this->profile->nationality($region),
            'marital_status' => $this->maritalStatus($age),
            'phone' => $this->phone($region),
            'email' => $this->email($name),
        ];
    }

    private function maritalStatus(int $age): string
    {
        $marriedOdds = match (true) {
            $age < 26 => 0.25,
            $age < 30 => 0.55,
            $age < 40 => 0.8,
            default => 0.88,
        };

        if ($this->random->bool($marriedOdds)) {
            return 'married';
        }

        if ($age >= 45 && $this->random->bool(0.3)) {
            return 'widowed';
        }

        if ($age >= 28 && $this->random->bool(0.35)) {
            return 'divorced';
        }

        return 'single';
    }

    private function phone(string $region): string
    {
        $patterns = $this->profile->phonePatterns($region);

        if ($patterns === []) {
            return '';
        }

        return (string) preg_replace_callback(
            '/#/',
            fn (): string => (string) $this->random->int(0, 9),
            $this->random->pick($patterns),
        );
    }

    /**
     * @param  array{first: string, middle: string, last: string}  $name
     */
    private function email(array $name): string
    {
        $first = $this->slug($name['first']);
        $middle = $this->slug($name['middle']);
        $last = $this->slug($name['last']);
        $digits = (string) $this->random->int(1, 99);
        $year = (string) $this->random->int(70, 99);

        $local = match ($this->random->weightedKey([1 => 30, 2 => 20, 3 => 15, 4 => 15, 5 => 10, 6 => 10])) {
            1 => "{$first}.{$middle}",
            2 => "{$first}{$middle}{$digits}",
            3 => "{$first}.{$middle}.{$last}",
            4 => "{$first}{$digits}",
            5 => "{$first}_{$middle}",
            default => substr($first, 0, 1).$middle.$year,
        };

        $domain = (string) $this->random->weightedKey($this->profile->emailDomains());

        return "{$local}@{$domain}";
    }

    /**
     * Lower-case ASCII local-part segment: drops apostrophes, hyphens, spaces.
     */
    private function slug(string $name): string
    {
        $ascii = function_exists('iconv') ? (string) @iconv('UTF-8', 'ASCII//TRANSLIT', $name) : $name;

        return (string) preg_replace('/[^a-z]/', '', strtolower($ascii));
    }
}
