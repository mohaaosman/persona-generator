<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | The locale whose data files drive generation when none is supplied at
    | runtime via PersonaFactory::locale(). Each locale is a directory of PHP
    | array files under the data path below.
    |
    */

    'default_locale' => env('PERSONA_LOCALE', 'so'),

    /*
    |--------------------------------------------------------------------------
    | Data Path
    |--------------------------------------------------------------------------
    |
    | Absolute path to the directory containing per-locale data folders. Leave
    | null to use the package's bundled data (resources/lang). Publish the data
    | (vendor:publish --tag=persona-generator-data) and point here to override.
    |
    */

    'data_path' => env('PERSONA_DATA_PATH'),

    /*
    |--------------------------------------------------------------------------
    | AI Prose
    |--------------------------------------------------------------------------
    |
    | When enabled, bio() and coverLetter() are generated with the laravel/ai
    | SDK for genuinely natural prose. When disabled (default), offline sentence
    | templates are used. AI prose is non-deterministic even with a seed; the
    | seed governs only the structured fields. Any AI failure falls back to the
    | template driver, so seeding never breaks.
    |
    */

    'ai' => [
        'enabled' => env('PERSONA_AI_PROSE', false),
        'provider' => env('PERSONA_AI_PROVIDER', 'anthropic'),
        'model' => env('PERSONA_AI_MODEL'),
    ],

];
