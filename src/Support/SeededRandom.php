<?php

namespace PersonaGenerator\Support;

use Random\Engine\Mt19937;
use Random\Randomizer;

/**
 * A small, isolated random source. When seeded it is fully reproducible; when
 * not seeded it uses the platform CSPRNG. It deliberately wraps its own
 * Randomizer instance rather than touching global mt_srand(), so generation
 * never perturbs the host app's faker sequence.
 */
class SeededRandom
{
    private Randomizer $randomizer;

    public function __construct(?int $seed = null)
    {
        $this->randomizer = $seed === null
            ? new Randomizer
            : new Randomizer(new Mt19937($seed));
    }

    public function int(int $min, int $max): int
    {
        return $this->randomizer->getInt($min, $max);
    }

    /**
     * Pick one element from a list (values, not keys).
     *
     * @template T
     *
     * @param  array<int, T>  $items
     * @return T
     */
    public function pick(array $items): mixed
    {
        $values = array_values($items);

        return $values[$this->int(0, count($values) - 1)];
    }

    /**
     * Pick a key from a weighted map of [value => weight].
     *
     * @param  array<array-key, int>  $weights
     */
    public function weightedKey(array $weights): int|string
    {
        $total = array_sum($weights);
        $roll = $this->int(1, max(1, $total));
        $cursor = 0;

        foreach ($weights as $key => $weight) {
            $cursor += $weight;
            if ($roll <= $cursor) {
                return $key;
            }
        }

        return array_key_last($weights);
    }

    /**
     * Return true with the given probability (0.0 - 1.0).
     */
    public function bool(float $probability = 0.5): bool
    {
        return $this->int(1, 1000) <= (int) round($probability * 1000);
    }

    /**
     * Return a shuffled copy of the list (deterministic for a given seed).
     *
     * @template T
     *
     * @param  array<int, T>  $items
     * @return array<int, T>
     */
    public function shuffle(array $items): array
    {
        return $this->randomizer->shuffleArray(array_values($items));
    }
}
