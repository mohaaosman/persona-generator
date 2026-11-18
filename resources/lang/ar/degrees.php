<?php

/*
 * Degree levels with English and Arabic labels. The `level` key drives the
 * coherence logic (diploma < bachelor < master < phd) in the TimelineBuilder.
 *
 * Optional `families` limits a degree to fields of those career families; a
 * degree without `families` suits every field.
 */

return [
    ['level' => 'diploma', 'en' => 'Diploma', 'ar' => 'دبلوم'],
    ['level' => 'bachelor', 'en' => 'Bachelor of Science', 'ar' => 'بكالوريوس العلوم', 'families' => ['public_admin', 'finance', 'business', 'engineering', 'ict', 'health', 'agriculture', 'social']],
    ['level' => 'bachelor', 'en' => 'Bachelor of Arts', 'ar' => 'بكالوريوس الآداب', 'families' => ['public_admin', 'finance', 'business', 'education', 'social']],
    ['level' => 'bachelor', 'en' => 'Bachelor of Laws', 'ar' => 'بكالوريوس القانون', 'families' => ['law']],
    ['level' => 'master', 'en' => 'Master of Science', 'ar' => 'ماجستير العلوم', 'families' => ['public_admin', 'finance', 'business', 'engineering', 'ict', 'health', 'education', 'agriculture', 'social']],
    ['level' => 'master', 'en' => 'Master of Arts', 'ar' => 'ماجستير الآداب', 'families' => ['public_admin', 'education', 'social']],
    ['level' => 'master', 'en' => 'Master of Business Administration', 'ar' => 'ماجستير إدارة الأعمال', 'families' => ['public_admin', 'finance', 'business']],
    ['level' => 'master', 'en' => 'Master of Laws', 'ar' => 'ماجستير القانون', 'families' => ['law']],
    ['level' => 'phd', 'en' => 'Doctor of Philosophy', 'ar' => 'دكتوراه الفلسفة'],
];
