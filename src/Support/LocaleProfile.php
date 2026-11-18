<?php

namespace PersonaGenerator\Support;

use PersonaGenerator\Contracts\LocaleRepository;

/**
 * Read-only view over a locale's profile.php, resolving per-region overrides.
 *
 * A region entry may override `country`, `nationality`, `phone`, `local`
 * (the region's display name in the local language) and `languages`
 * (merged over the locale's base language odds).
 */
class LocaleProfile
{
    /** @var array<string, mixed> */
    private readonly array $profile;

    public function __construct(private readonly LocaleRepository $locale)
    {
        $this->profile = $locale->profile();
    }

    public function country(string $region): string
    {
        return (string) ($this->forRegion($region, 'country') ?? $region);
    }

    public function nationality(string $region): string
    {
        return (string) ($this->forRegion($region, 'nationality') ?? '');
    }

    /**
     * The region's name in the local language (falls back to the region key).
     */
    public function localRegionName(string $region): string
    {
        return (string) ($this->profile['regions'][$region]['local'] ?? $region);
    }

    /** @return array<int, string> */
    public function phonePatterns(string $region): array
    {
        return array_values((array) ($this->forRegion($region, 'phone') ?? []));
    }

    /** @return array<string, int> domain => weight */
    public function emailDomains(): array
    {
        return $this->profile['email_domains'] ?? ['gmail.com' => 1];
    }

    /**
     * Language odds for a home region: [language => probability], native first.
     *
     * @return array<string, float>
     */
    public function languages(string $region): array
    {
        $odds = [];
        foreach ($this->locale->languages() as $key => $value) {
            // Accept both a plain list (legacy: native first, others at 30%)
            // and a [language => probability] map.
            if (is_int($key)) {
                $odds[(string) $value] = $odds === [] ? 1.0 : 0.3;
            } else {
                $odds[$key] = (float) $value;
            }
        }

        foreach ((array) ($this->profile['regions'][$region]['languages'] ?? []) as $language => $p) {
            $odds[$language] = (float) $p;
        }

        return $odds;
    }

    /** @return array<string, float> language => probability for postgraduates */
    public function postgraduateLanguages(): array
    {
        return array_map('floatval', (array) ($this->profile['postgraduate'] ?? []));
    }

    /**
     * Whether government employers only hire nationals of their own region
     * (true for the pan-Arab locale, where each region is a country).
     */
    public function governmentHomeOnly(): bool
    {
        return (bool) ($this->profile['government_home_only'] ?? false);
    }

    public function homeEmployerProbability(float $default): float
    {
        return (float) ($this->profile['home_employer_probability'] ?? $default);
    }

    private function forRegion(string $region, string $key): mixed
    {
        return $this->profile['regions'][$region][$key] ?? $this->profile[$key] ?? null;
    }
}
