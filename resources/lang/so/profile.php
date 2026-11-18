<?php

/*
 * Person-level details for the Somali locale: nationality, phone numbering,
 * e-mail habits and marital-status odds. `regions` overrides any of these per
 * home region (keys must match regions.php).
 *
 * Phone patterns: every '#' becomes a random digit. Somali mobile numbers are
 * +252 followed by a two-digit operator prefix and seven digits.
 */

return [
    'country' => 'Somalia',
    'nationality' => 'Somali',

    // Default (south/central) operator prefixes.
    'phone' => ['+252 61 #######', '+252 61 #######', '+252 77 #######', '+252 68 #######'],

    // Postgraduates are likelier to speak these.
    'postgraduate' => ['English' => 0.9],

    'email_domains' => ['gmail.com' => 70, 'hotmail.com' => 12, 'yahoo.com' => 10, 'outlook.com' => 8],

    'regions' => [
        // Northern regions use northern operators.
        'Woqooyi Galbeed' => ['phone' => ['+252 63 #######', '+252 65 #######']],
        'Awdal' => ['phone' => ['+252 63 #######', '+252 65 #######']],
        'Togdheer' => ['phone' => ['+252 63 #######', '+252 65 #######']],
        'Sool' => ['phone' => ['+252 63 #######', '+252 90 #######']],
        'Sanaag' => ['phone' => ['+252 63 #######', '+252 90 #######']],
        // North-east.
        'Bari' => ['phone' => ['+252 90 #######']],
        'Nugaal' => ['phone' => ['+252 90 #######']],
        'Mudug' => ['phone' => ['+252 90 #######', '+252 61 #######']],
        // Border regions: Swahili more common.
        'Lower Juba' => ['languages' => ['Swahili' => 0.35]],
        'Gedo' => ['languages' => ['Swahili' => 0.3]],
    ],
];
