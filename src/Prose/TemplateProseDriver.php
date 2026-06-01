<?php

namespace PersonaGenerator\Prose;

use PersonaGenerator\Contracts\LocaleRepository;
use PersonaGenerator\Contracts\ProseDriver;
use PersonaGenerator\Persona;
use PersonaGenerator\Support\SeededRandom;

/**
 * Offline prose generator. Stitches sentence templates from the locale data and
 * interpolates persona facts. Deterministic: variant selection is driven by the
 * persona's fingerprint, so the same persona always yields the same prose.
 */
class TemplateProseDriver implements ProseDriver
{
    public function __construct(private readonly LocaleRepository $locale) {}

    public function bio(Persona $persona): string
    {
        $templates = $this->locale->templates();
        $random = new SeededRandom($persona->fingerprint);
        $tokens = $this->tokens($persona);

        $bio = $this->interpolate($random->pick($templates['bio']), $tokens);
        $bio .= $this->interpolate($random->pick($templates['bio_suffix']), $tokens);

        return $bio;
    }

    public function coverLetter(Persona $persona): string
    {
        $sections = $this->locale->templates()['cover_letter'];
        $random = new SeededRandom($persona->fingerprint + 1);
        $tokens = $this->tokens($persona);

        $parts = [
            $this->interpolate($random->pick($sections['intro']), $tokens),
            $this->interpolate($random->pick($sections['experience']), $tokens),
            $this->interpolate($random->pick($sections['education']), $tokens),
            $this->interpolate($random->pick($sections['motivation']), $tokens),
            $this->interpolate($random->pick($sections['closing']), $tokens),
            $this->interpolate($random->pick($sections['signature']), $tokens),
        ];

        return implode("\n\n", $parts);
    }

    /**
     * @return array<string, string>
     */
    private function tokens(Persona $persona): array
    {
        $current = $persona->currentEmployment();
        $highest = $persona->highestEducation();
        $female = $persona->gender->isFemale();

        return [
            ':first_name' => $persona->first_name,
            ':full_name' => $persona->full_name,
            ':role' => $current?->role ?? 'a public-sector professional',
            ':organisation' => $current?->organisation ?? 'a government institution',
            ':years' => (string) $persona->yearsOfExperience(),
            ':degree' => $highest?->degree ?? 'a degree',
            ':field' => $highest?->field ?? 'public administration',
            ':institution' => $highest?->institution ?? 'university',
            ':languages' => $this->formatList($persona->spokenLanguages()),
            ':region' => $persona->region(),
            ':pronoun_subject' => $female ? 'She' : 'He',
            ':pronoun_possessive' => $female ? 'Her' : 'His',
        ];
    }

    /**
     * @param  array<string, string>  $tokens
     */
    private function interpolate(string $template, array $tokens): string
    {
        return strtr($template, $tokens);
    }

    /**
     * @param  array<int, string>  $items
     */
    private function formatList(array $items): string
    {
        if (count($items) <= 1) {
            return implode('', $items);
        }

        $last = array_pop($items);

        return implode(', ', $items).' and '.$last;
    }
}
