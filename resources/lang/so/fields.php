<?php

/*
 * Fields of study with English and Somali labels, each tagged with a career
 * `family`. The family keys the role ladder in job_titles.php, so a persona's
 * field of study determines the kind of jobs they hold (a Civil Engineering
 * graduate gets engineering roles, not finance ones). Every `family` used here
 * MUST exist in job_titles.php.
 */

return [
    // Public administration & governance
    ['en' => 'Public Administration', 'so' => 'Maamulka Dadweynaha', 'family' => 'public_admin'],
    ['en' => 'Political Science', 'so' => 'Sayniska Siyaasadda', 'family' => 'public_admin'],
    ['en' => 'International Relations', 'so' => 'Xiriirka Caalamiga', 'family' => 'public_admin'],
    ['en' => 'Public Policy', 'so' => 'Siyaasadda Dadweynaha', 'family' => 'public_admin'],
    ['en' => 'Governance and Diplomacy', 'so' => 'Maamulka iyo Diblumaasiyada', 'family' => 'public_admin'],

    // Finance & economics
    ['en' => 'Economics', 'so' => 'Dhaqaalaha', 'family' => 'finance'],
    ['en' => 'Accounting', 'so' => 'Xisaabaadka', 'family' => 'finance'],
    ['en' => 'Finance and Banking', 'so' => 'Maaliyadda iyo Bangiyada', 'family' => 'finance'],
    ['en' => 'Statistics', 'so' => 'Tirakoobka', 'family' => 'finance'],

    // Business & management
    ['en' => 'Business Management', 'so' => 'Maaraynta Ganacsiga', 'family' => 'business'],
    ['en' => 'Marketing', 'so' => 'Suuq-geynta', 'family' => 'business'],
    ['en' => 'Procurement and Logistics', 'so' => 'Wax-iibsiga iyo Saadka', 'family' => 'business'],
    ['en' => 'Human Resource Management', 'so' => 'Maaraynta Shaqaalaha', 'family' => 'business'],

    // Law
    ['en' => 'Law', 'so' => 'Sharciga', 'family' => 'law'],
    ['en' => 'Sharia and Islamic Law', 'so' => 'Shareecada iyo Sharciga Islaamka', 'family' => 'law'],

    // Engineering
    ['en' => 'Civil Engineering', 'so' => 'Injineerinta Dhismaha', 'family' => 'engineering'],
    ['en' => 'Mechanical Engineering', 'so' => 'Injineerinta Makaanikada', 'family' => 'engineering'],
    ['en' => 'Electrical Engineering', 'so' => 'Injineerinta Korontada', 'family' => 'engineering'],
    ['en' => 'Architecture', 'so' => 'Naqshadaynta Dhismaha', 'family' => 'engineering'],
    ['en' => 'Water and Environmental Engineering', 'so' => 'Injineerinta Biyaha iyo Deegaanka', 'family' => 'engineering'],

    // Information & communications technology
    ['en' => 'Computer Science', 'so' => 'Sayniska Kombiyuutarka', 'family' => 'ict'],
    ['en' => 'Information Technology', 'so' => 'Tignoolajiyada Macluumaadka', 'family' => 'ict'],
    ['en' => 'Software Engineering', 'so' => 'Injineerinta Barnaamijyada', 'family' => 'ict'],
    ['en' => 'Telecommunications Engineering', 'so' => 'Injineerinta Isgaarsiinta', 'family' => 'ict'],
    ['en' => 'Information Systems', 'so' => 'Nidaamyada Macluumaadka', 'family' => 'ict'],

    // Health & medicine
    ['en' => 'Medicine', 'so' => 'Caafimaadka', 'family' => 'health'],
    ['en' => 'Public Health', 'so' => 'Caafimaadka Bulshada', 'family' => 'health'],
    ['en' => 'Nursing', 'so' => 'Kalkaalinta Caafimaad', 'family' => 'health'],
    ['en' => 'Pharmacy', 'so' => 'Farmashiyaha', 'family' => 'health'],
    ['en' => 'Midwifery', 'so' => 'Umulisanimada', 'family' => 'health'],

    // Education
    ['en' => 'Education', 'so' => 'Waxbarashada', 'family' => 'education'],
    ['en' => 'Educational Leadership', 'so' => 'Hoggaaminta Waxbarashada', 'family' => 'education'],
    ['en' => 'Curriculum and Teaching', 'so' => 'Manhajka iyo Waxbaridda', 'family' => 'education'],

    // Agriculture & environment
    ['en' => 'Agriculture', 'so' => 'Beeraha', 'family' => 'agriculture'],
    ['en' => 'Veterinary Medicine', 'so' => 'Caafimaadka Xoolaha', 'family' => 'agriculture'],
    ['en' => 'Fisheries and Marine Science', 'so' => 'Kalluumeysiga iyo Sayniska Badda', 'family' => 'agriculture'],
    ['en' => 'Environmental Science', 'so' => 'Sayniska Deegaanka', 'family' => 'agriculture'],

    // Social sciences & development
    ['en' => 'Social Work', 'so' => 'Shaqada Bulshada', 'family' => 'social'],
    ['en' => 'Sociology', 'so' => 'Cilminafsiga Bulshada', 'family' => 'social'],
    ['en' => 'Development Studies', 'so' => 'Daraasaadka Horumarinta', 'family' => 'social'],
    ['en' => 'Psychology', 'so' => 'Cilminafsiga', 'family' => 'social'],
];
