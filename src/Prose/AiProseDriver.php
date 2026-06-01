<?php

namespace PersonaGenerator\Prose;

use PersonaGenerator\Contracts\ProseDriver;
use PersonaGenerator\Persona;
use Throwable;

use function Laravel\Ai\agent;

/**
 * Generates bio/cover-letter prose with the laravel/ai SDK. Non-deterministic by
 * nature — the seed governs only structured fields. Any failure (missing key,
 * network, SDK absent) is caught and delegated to the offline template driver,
 * so seeding never breaks.
 */
class AiProseDriver implements ProseDriver
{
    public function __construct(
        private readonly TemplateProseDriver $fallback,
        private readonly string $provider = 'anthropic',
        private readonly ?string $model = null,
    ) {}

    public function bio(Persona $persona): string
    {
        return $this->generate(
            instructions: 'You write concise, realistic professional bios (2-3 sentences) for Somali civil-service candidates. Return only the bio, no preamble.',
            prompt: $this->factsPrompt($persona)."\n\nWrite a 2-3 sentence first-person-neutral professional bio.",
        ) ?? $this->fallback->bio($persona);
    }

    public function coverLetter(Persona $persona): string
    {
        return $this->generate(
            instructions: 'You write professional cover letters for Somali civil-service job applicants. Return only the letter body, no preamble.',
            prompt: $this->factsPrompt($persona)."\n\nWrite a formal 4-5 paragraph cover letter applying for a public-sector position.",
        ) ?? $this->fallback->coverLetter($persona);
    }

    private function generate(string $instructions, string $prompt): ?string
    {
        try {
            $args = ['provider' => $this->provider];
            if ($this->model !== null) {
                $args['model'] = $this->model;
            }

            $text = trim((string) agent(instructions: $instructions)->prompt($prompt, ...$args));

            return $text !== '' ? $text : null;
        } catch (Throwable $e) {
            report($e);

            return null;
        }
    }

    private function factsPrompt(Persona $persona): string
    {
        $highest = $persona->highestEducation();
        $current = $persona->currentEmployment();

        return implode("\n", array_filter([
            "Name: {$persona->full_name}",
            "Gender: {$persona->gender->value}",
            "Age: {$persona->age}",
            "Home region: {$persona->region()}",
            $highest ? "Highest education: {$highest->degree} in {$highest->field} from {$highest->institution} ({$highest->endYear})" : null,
            $current ? "Current role: {$current->role} at {$current->organisation}" : null,
            "Years of experience: {$persona->yearsOfExperience()}",
            'Languages: '.implode(', ', $persona->spokenLanguages()),
        ]));
    }
}
