<?php

/*
 * Person-level details for the pan-Arab locale. Every region in regions.php is
 * a country, so each one declares its own nationality, phone numbering and
 * (optionally) language odds and Arabic display name (`local`).
 *
 * Phone patterns: every '#' becomes a random digit.
 */

return [
    // Each region is a country: civil-service posts go to nationals, and most
    // careers stay in the home country (with some private/NGO moves abroad).
    'government_home_only' => true,
    'home_employer_probability' => 0.8,

    'postgraduate' => ['English' => 0.9],

    'email_domains' => ['gmail.com' => 60, 'hotmail.com' => 18, 'outlook.com' => 12, 'yahoo.com' => 10],

    'regions' => [
        'Saudi Arabia' => [
            'country' => 'Saudi Arabia', 'nationality' => 'Saudi', 'local' => 'المملكة العربية السعودية',
            'phone' => ['+966 50 ### ####', '+966 53 ### ####', '+966 55 ### ####', '+966 56 ### ####', '+966 59 ### ####'],
            'languages' => ['English' => 0.7],
        ],
        'United Arab Emirates' => [
            'country' => 'United Arab Emirates', 'nationality' => 'Emirati', 'local' => 'الإمارات العربية المتحدة',
            'phone' => ['+971 50 ### ####', '+971 52 ### ####', '+971 55 ### ####', '+971 56 ### ####'],
            'languages' => ['English' => 0.85],
        ],
        'Qatar' => [
            'country' => 'Qatar', 'nationality' => 'Qatari', 'local' => 'قطر',
            'phone' => ['+974 3### ####', '+974 5### ####', '+974 6### ####', '+974 7### ####'],
            'languages' => ['English' => 0.85],
        ],
        'Kuwait' => [
            'country' => 'Kuwait', 'nationality' => 'Kuwaiti', 'local' => 'الكويت',
            'phone' => ['+965 5### ####', '+965 6### ####', '+965 9### ####'],
            'languages' => ['English' => 0.8],
        ],
        'Oman' => [
            'country' => 'Oman', 'nationality' => 'Omani', 'local' => 'سلطنة عُمان',
            'phone' => ['+968 9### ####', '+968 7### ####'],
            'languages' => ['English' => 0.75, 'Swahili' => 0.05],
        ],
        'Bahrain' => [
            'country' => 'Bahrain', 'nationality' => 'Bahraini', 'local' => 'البحرين',
            'phone' => ['+973 3### ####'],
            'languages' => ['English' => 0.85],
        ],
        'Jordan' => [
            'country' => 'Jordan', 'nationality' => 'Jordanian', 'local' => 'الأردن',
            'phone' => ['+962 77 ### ####', '+962 78 ### ####', '+962 79 ### ####'],
            'languages' => ['English' => 0.75],
        ],
        'Egypt' => [
            'country' => 'Egypt', 'nationality' => 'Egyptian', 'local' => 'مصر',
            'phone' => ['+20 10 #### ####', '+20 11 #### ####', '+20 12 #### ####', '+20 15 #### ####'],
            'languages' => ['English' => 0.6, 'French' => 0.1],
        ],
        'Sudan' => [
            'country' => 'Sudan', 'nationality' => 'Sudanese', 'local' => 'السودان',
            'phone' => ['+249 91 ### ####', '+249 92 ### ####', '+249 99 ### ####', '+249 90 ### ####'],
            'languages' => ['English' => 0.55],
        ],
        'Morocco' => [
            'country' => 'Morocco', 'nationality' => 'Moroccan', 'local' => 'المغرب',
            'phone' => ['+212 6## ## ## ##', '+212 7## ## ## ##'],
            'languages' => ['French' => 0.8, 'English' => 0.4, 'Tamazight' => 0.3, 'Spanish' => 0.1],
        ],
        'Iraq' => [
            'country' => 'Iraq', 'nationality' => 'Iraqi', 'local' => 'العراق',
            'phone' => ['+964 770 ### ####', '+964 780 ### ####', '+964 750 ### ####'],
            'languages' => ['English' => 0.5, 'Kurdish' => 0.15],
        ],
        'Yemen' => [
            'country' => 'Yemen', 'nationality' => 'Yemeni', 'local' => 'اليمن',
            'phone' => ['+967 77# ### ###', '+967 73# ### ###', '+967 71# ### ###'],
            'languages' => ['English' => 0.45],
        ],
    ],
];
