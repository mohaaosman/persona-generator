<?php

/*
 * Job titles grouped by seniority. The TimelineBuilder escalates through these
 * tiers (junior -> mid -> senior) across a persona's successive positions.
 */

return [
    'junior' => [
        ['en' => 'Administrative Assistant', 'so' => 'Kaaliye Maamul'],
        ['en' => 'Programme Officer', 'so' => 'Sarkaal Barnaamij'],
        ['en' => 'Finance Officer', 'so' => 'Sarkaal Maaliyadeed'],
        ['en' => 'Data Clerk', 'so' => 'Karaani Xog'],
        ['en' => 'Field Officer', 'so' => 'Sarkaal Goob'],
        ['en' => 'Project Assistant', 'so' => 'Kaaliye Mashruuc'],
    ],
    'mid' => [
        ['en' => 'Senior Programme Officer', 'so' => 'Sarkaal Sare Barnaamij'],
        ['en' => 'Project Coordinator', 'so' => 'Isuduwe Mashruuc'],
        ['en' => 'Monitoring and Evaluation Officer', 'so' => 'Sarkaal La-socod iyo Qiimayn'],
        ['en' => 'Human Resources Officer', 'so' => 'Sarkaal Shaqaale'],
        ['en' => 'Procurement Specialist', 'so' => 'Khabiir Wax-iibsi'],
        ['en' => 'Public Relations Officer', 'so' => 'Sarkaal Xiriirka Dadweynaha'],
    ],
    'senior' => [
        ['en' => 'Department Director', 'so' => 'Agaasimaha Waaxda'],
        ['en' => 'Programme Manager', 'so' => 'Maareeyaha Barnaamijka'],
        ['en' => 'Policy Advisor', 'so' => 'La-taliye Siyaasadeed'],
        ['en' => 'Head of Finance', 'so' => 'Madaxa Maaliyadda'],
        ['en' => 'Director General', 'so' => 'Agaasime Guud'],
        ['en' => 'Technical Advisor', 'so' => 'La-taliye Farsamo'],
    ],
];
