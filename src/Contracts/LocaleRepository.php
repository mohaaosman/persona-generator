<?php

namespace PersonaGenerator\Contracts;

/**
 * Resolves the data pools for a given locale. Each method returns the raw array
 * loaded from that locale's data file.
 */
interface LocaleRepository
{
    public function locale(): string;

    public function withLocale(string $locale): static;

    /** @return array<int, string> */
    public function femaleFirstNames(): array;

    /** @return array<int, string> */
    public function maleFirstNames(): array;

    /** @return array<string, array<int, string>> region => [cities] */
    public function regions(): array;

    /** @return array<string, string> institution => country */
    public function universities(): array;

    /** @return array<int, array{level: string, en: string, so: string}> */
    public function degrees(): array;

    /** @return array<int, array{en: string, so: string, family: string}> */
    public function fields(): array;

    /** @return array<int, array{name: string, sector: string, region: string}> */
    public function employers(): array;

    /** @return array<string, array<string, array<int, array{en: string, so: string}>>> family => seniority => titles */
    public function jobTitles(): array;

    /**
     * Spoken languages, either a plain list or [language => probability]. The
     * first entry is the native language and is always spoken.
     *
     * @return array<int|string, string|float>
     */
    public function languages(): array;

    /**
     * Person-level locale details: country, nationality, phone patterns,
     * e-mail domains, postgraduate language boosts and per-region overrides.
     * An empty array is valid (sensible defaults apply).
     *
     * @return array<string, mixed>
     */
    public function profile(): array;

    /** @return array<string, mixed> */
    public function templates(): array;
}
