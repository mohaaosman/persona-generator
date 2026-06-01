<?php

/*
 * Degree levels with English and Somali labels. The `level` key drives the
 * coherence logic (diploma < bachelor < master < phd) in the TimelineBuilder.
 */

return [
    ['level' => 'diploma', 'en' => 'Diploma', 'so' => 'Dibloomo'],
    ['level' => 'bachelor', 'en' => 'Bachelor of Science', 'so' => 'Shahaadada Koowaad (BSc)'],
    ['level' => 'bachelor', 'en' => 'Bachelor of Arts', 'so' => 'Shahaadada Koowaad (BA)'],
    ['level' => 'master', 'en' => 'Master of Science', 'so' => 'Shahaadada Labaad (MSc)'],
    ['level' => 'master', 'en' => 'Master of Business Administration', 'so' => 'Shahaadada Labaad (MBA)'],
    ['level' => 'phd', 'en' => 'Doctor of Philosophy', 'so' => 'Shahaadada Dhakhtarnimo (PhD)'],
];
