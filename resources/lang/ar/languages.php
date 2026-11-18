<?php

/*
 * Spoken languages as [language => probability]. The FIRST entry is the
 * native language and is always included; the rest are added with the given
 * probability. Country-specific overrides (e.g. French in Morocco) live in
 * profile.php, and postgraduates get the `postgraduate` boosts from there too.
 */

return [
    'Arabic' => 1.0,
    'English' => 0.65,
    'French' => 0.08,
];
