<?php

namespace PersonaGenerator\Support;

use InvalidArgumentException;
use PersonaGenerator\Contracts\LocaleRepository;
use RuntimeException;

/**
 * Loads locale data from PHP array files under a base directory:
 * "{basePath}/{locale}/{file}.php". Loaded arrays are cached per instance.
 */
class ArrayLocaleRepository implements LocaleRepository
{
    /** @var array<string, array<int|string, mixed>> */
    private array $cache = [];

    public function __construct(
        private readonly string $basePath,
        private string $locale,
    ) {}

    public function locale(): string
    {
        return $this->locale;
    }

    public function withLocale(string $locale): static
    {
        $clone = clone $this;
        $clone->locale = $locale;
        $clone->cache = [];

        return $clone;
    }

    /** @return array<int, string> */
    public function femaleFirstNames(): array
    {
        return $this->load('female_first_names');
    }

    /** @return array<int, string> */
    public function maleFirstNames(): array
    {
        return $this->load('male_first_names');
    }

    /** @return array<string, array<int, string>> */
    public function regions(): array
    {
        return $this->load('regions');
    }

    /** @return array<string, string> */
    public function universities(): array
    {
        return $this->load('universities');
    }

    /** @return array<int, array{level: string, en: string, so: string}> */
    public function degrees(): array
    {
        return $this->load('degrees');
    }

    /** @return array<int, array{en: string, so: string}> */
    public function fields(): array
    {
        return $this->load('fields');
    }

    /** @return array<int, array{name: string, region: string}> */
    public function employers(): array
    {
        return $this->load('employers');
    }

    /** @return array<string, array<int, array{en: string, so: string}>> */
    public function jobTitles(): array
    {
        return $this->load('job_titles');
    }

    /** @return array<int, string> */
    public function languages(): array
    {
        return $this->load('languages');
    }

    /** @return array<string, mixed> */
    public function templates(): array
    {
        return $this->load('templates');
    }

    /**
     * @return array<int|string, mixed>
     */
    private function load(string $file): array
    {
        if (isset($this->cache[$file])) {
            return $this->cache[$file];
        }

        $path = "{$this->basePath}/{$this->locale}/{$file}.php";

        if (! is_file($path)) {
            throw new InvalidArgumentException(
                "Persona data file [{$file}] is missing for locale [{$this->locale}] at: {$path}"
            );
        }

        $data = require $path;

        if (! is_array($data)) {
            throw new RuntimeException("Persona data file [{$path}] must return an array.");
        }

        return $this->cache[$file] = $data;
    }
}
