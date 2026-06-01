<?php

use PersonaGenerator\Support\SeededRandom;

it('reproduces the same sequence for a given seed', function (): void {
    $a = new SeededRandom(42);
    $b = new SeededRandom(42);

    $seqA = array_map(fn (): int => $a->int(1, 1_000_000), range(1, 20));
    $seqB = array_map(fn (): int => $b->int(1, 1_000_000), range(1, 20));

    expect($seqA)->toBe($seqB);
});

it('does not perturb the global mt_rand sequence', function (): void {
    mt_srand(7);
    $expected = mt_rand();

    mt_srand(7);
    $random = new SeededRandom(123);
    $random->int(1, 100);
    $random->shuffle([1, 2, 3, 4, 5]);
    $actual = mt_rand();

    expect($actual)->toBe($expected);
});

it('picks a value from the supplied list', function (): void {
    $random = new SeededRandom(1);

    expect(['a', 'b', 'c'])->toContain($random->pick(['a', 'b', 'c']));
});

it('returns a key that exists in the weighted map', function (): void {
    $random = new SeededRandom(1);

    expect(['low', 'mid', 'high'])
        ->toContain($random->weightedKey(['low' => 1, 'mid' => 5, 'high' => 2]));
});

it('returns true and false for the boundary probabilities', function (): void {
    $random = new SeededRandom(1);

    expect($random->bool(1.0))->toBeTrue()
        ->and($random->bool(0.0))->toBeFalse();
});
