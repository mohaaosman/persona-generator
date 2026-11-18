<?php

/*
 * Degree levels with English and Somali labels. The `level` key drives the
 * coherence logic (diploma < bachelor < master < phd) in the TimelineBuilder.
 *
 * Optional `families` limits a degree to fields of those career families (so a
 * Law graduate holds an LLB, not a BSc, and nobody earns an MBA in Medicine).
 * A degree without `families` suits every field.
 */

return [
    ['level' => 'diploma', 'en' => 'Diploma', 'so' => 'Dibloomo'],
    ['level' => 'bachelor', 'en' => 'Bachelor of Science', 'so' => 'Shahaadada Koowaad (BSc)', 'families' => ['public_admin', 'finance', 'business', 'engineering', 'ict', 'health', 'education', 'agriculture', 'social']],
    ['level' => 'bachelor', 'en' => 'Bachelor of Arts', 'so' => 'Shahaadada Koowaad (BA)', 'families' => ['public_admin', 'finance', 'business', 'education', 'social']],
    ['level' => 'bachelor', 'en' => 'Bachelor of Laws', 'so' => 'Shahaadada Koowaad ee Sharciga (LLB)', 'families' => ['law']],
    ['level' => 'master', 'en' => 'Master of Science', 'so' => 'Shahaadada Labaad (MSc)', 'families' => ['public_admin', 'finance', 'business', 'engineering', 'ict', 'health', 'education', 'agriculture', 'social']],
    ['level' => 'master', 'en' => 'Master of Arts', 'so' => 'Shahaadada Labaad (MA)', 'families' => ['public_admin', 'education', 'social']],
    ['level' => 'master', 'en' => 'Master of Business Administration', 'so' => 'Shahaadada Labaad (MBA)', 'families' => ['public_admin', 'finance', 'business']],
    ['level' => 'master', 'en' => 'Master of Laws', 'so' => 'Shahaadada Labaad ee Sharciga (LLM)', 'families' => ['law']],
    ['level' => 'phd', 'en' => 'Doctor of Philosophy', 'so' => 'Shahaadada Dhakhtarnimo (PhD)'],
];
