<?php

/*
 * Employers with a `sector` (government | ngo | private) and the country
 * (`region`) they sit in. The TimelineBuilder weights selection toward the
 * public sector and toward employers in the persona's home country, so most
 * careers stay at home with the occasional move elsewhere in the region —
 * a common pattern for Gulf-bound professionals.
 */

return [

    // ---- Saudi Arabia --------------------------------------------------------
    ['name' => 'Ministry of Health (Saudi Arabia)', 'sector' => 'government', 'region' => 'Saudi Arabia', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Ministry of Education (Saudi Arabia)', 'sector' => 'government', 'region' => 'Saudi Arabia', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],
    ['name' => 'Ministry of Finance (Saudi Arabia)', 'sector' => 'government', 'region' => 'Saudi Arabia', 'families' => ['finance', 'business', 'public_admin', 'ict', 'law']],
    ['name' => 'General Authority for Statistics', 'sector' => 'government', 'region' => 'Saudi Arabia', 'families' => ['finance', 'ict', 'public_admin']],
    ['name' => 'Saudi Red Crescent Authority', 'sector' => 'government', 'region' => 'Saudi Arabia', 'families' => ['health', 'social', 'business']],
    ['name' => 'King Salman Humanitarian Aid and Relief Centre', 'sector' => 'ngo', 'region' => 'Saudi Arabia', 'families' => ['social', 'health', 'education', 'finance', 'public_admin']],
    ['name' => 'Saudi Aramco', 'sector' => 'private', 'region' => 'Saudi Arabia', 'families' => ['engineering', 'business', 'finance', 'ict', 'health', 'law']],
    ['name' => 'Saudi Telecom Company (stc)', 'sector' => 'private', 'region' => 'Saudi Arabia', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],
    ['name' => 'Al Rajhi Bank', 'sector' => 'private', 'region' => 'Saudi Arabia', 'families' => ['finance', 'business', 'ict', 'law']],

    ['name' => 'Ministry of Environment, Water and Agriculture (Saudi Arabia)', 'sector' => 'government', 'region' => 'Saudi Arabia', 'families' => ['agriculture', 'engineering', 'public_admin', 'finance']],

    // ---- United Arab Emirates -----------------------------------------------
    ['name' => 'Ministry of Health and Prevention (UAE)', 'sector' => 'government', 'region' => 'United Arab Emirates', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Dubai Municipality', 'sector' => 'government', 'region' => 'United Arab Emirates', 'families' => ['engineering', 'public_admin', 'finance', 'business', 'agriculture']],
    ['name' => 'Abu Dhabi Department of Education and Knowledge', 'sector' => 'government', 'region' => 'United Arab Emirates', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],
    ['name' => 'Dubai Electricity and Water Authority', 'sector' => 'government', 'region' => 'United Arab Emirates', 'families' => ['engineering', 'agriculture', 'public_admin', 'finance']],
    ['name' => 'Emirates Red Crescent', 'sector' => 'ngo', 'region' => 'United Arab Emirates', 'families' => ['health', 'social', 'business']],
    ['name' => 'Emirates NBD', 'sector' => 'private', 'region' => 'United Arab Emirates', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'e& (Etisalat)', 'sector' => 'private', 'region' => 'United Arab Emirates', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],

    // ---- Qatar ---------------------------------------------------------------
    ['name' => 'Ministry of Public Health (Qatar)', 'sector' => 'government', 'region' => 'Qatar', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Hamad Medical Corporation', 'sector' => 'government', 'region' => 'Qatar', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Qatar Foundation', 'sector' => 'ngo', 'region' => 'Qatar', 'families' => ['social', 'health', 'education', 'finance', 'public_admin']],
    ['name' => 'Qatar Charity', 'sector' => 'ngo', 'region' => 'Qatar', 'families' => ['social', 'health', 'education', 'finance', 'public_admin']],
    ['name' => 'QatarEnergy', 'sector' => 'private', 'region' => 'Qatar', 'families' => ['engineering', 'business', 'finance', 'ict', 'health', 'law']],
    ['name' => 'Ooredoo Qatar', 'sector' => 'private', 'region' => 'Qatar', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],

    ['name' => 'Ministry of Municipality and Environment (Qatar)', 'sector' => 'government', 'region' => 'Qatar', 'families' => ['agriculture', 'engineering', 'public_admin', 'finance']],

    // ---- Kuwait --------------------------------------------------------------
    ['name' => 'Ministry of Education (Kuwait)', 'sector' => 'government', 'region' => 'Kuwait', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],
    ['name' => 'Kuwait Municipality', 'sector' => 'government', 'region' => 'Kuwait', 'families' => ['engineering', 'public_admin', 'finance', 'business', 'agriculture']],
    ['name' => 'Kuwait Fund for Arab Economic Development', 'sector' => 'government', 'region' => 'Kuwait', 'families' => ['finance', 'public_admin', 'engineering', 'social']],
    ['name' => 'Kuwait Red Crescent Society', 'sector' => 'ngo', 'region' => 'Kuwait', 'families' => ['health', 'social', 'business']],
    ['name' => 'National Bank of Kuwait', 'sector' => 'private', 'region' => 'Kuwait', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Zain Kuwait', 'sector' => 'private', 'region' => 'Kuwait', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],

    // ---- Oman ----------------------------------------------------------------
    ['name' => 'Ministry of Health (Oman)', 'sector' => 'government', 'region' => 'Oman', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Muscat Municipality', 'sector' => 'government', 'region' => 'Oman', 'families' => ['engineering', 'public_admin', 'finance', 'business', 'agriculture']],
    ['name' => 'Oman Charitable Organization', 'sector' => 'ngo', 'region' => 'Oman', 'families' => ['social', 'health', 'education', 'finance', 'public_admin']],
    ['name' => 'Bank Muscat', 'sector' => 'private', 'region' => 'Oman', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Omantel', 'sector' => 'private', 'region' => 'Oman', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],

    // ---- Bahrain -------------------------------------------------------------
    ['name' => 'Ministry of Education (Bahrain)', 'sector' => 'government', 'region' => 'Bahrain', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],
    ['name' => 'Information & eGovernment Authority', 'sector' => 'government', 'region' => 'Bahrain', 'families' => ['ict', 'engineering', 'public_admin']],
    ['name' => 'Royal Humanitarian Foundation', 'sector' => 'ngo', 'region' => 'Bahrain', 'families' => ['social', 'health', 'education', 'finance', 'public_admin']],
    ['name' => 'Batelco', 'sector' => 'private', 'region' => 'Bahrain', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],
    ['name' => 'Bank of Bahrain and Kuwait', 'sector' => 'private', 'region' => 'Bahrain', 'families' => ['finance', 'business', 'ict', 'law']],

    ['name' => 'Ministry of Municipalities Affairs and Agriculture (Bahrain)', 'sector' => 'government', 'region' => 'Bahrain', 'families' => ['agriculture', 'engineering', 'public_admin', 'finance']],

    // ---- Jordan --------------------------------------------------------------
    ['name' => 'Ministry of Health (Jordan)', 'sector' => 'government', 'region' => 'Jordan', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Ministry of Planning and International Cooperation (Jordan)', 'sector' => 'government', 'region' => 'Jordan', 'families' => ['public_admin', 'finance', 'social', 'ict']],
    ['name' => 'Greater Amman Municipality', 'sector' => 'government', 'region' => 'Jordan', 'families' => ['engineering', 'public_admin', 'finance', 'business', 'agriculture']],
    ['name' => 'Jordan Hashemite Charity Organization', 'sector' => 'ngo', 'region' => 'Jordan', 'families' => ['social', 'health', 'education', 'finance', 'public_admin']],
    ['name' => 'UNRWA Jordan Field Office', 'sector' => 'ngo', 'region' => 'Jordan', 'families' => ['education', 'health', 'social', 'engineering', 'finance']],
    ['name' => 'Arab Bank', 'sector' => 'private', 'region' => 'Jordan', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Zain Jordan', 'sector' => 'private', 'region' => 'Jordan', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],

    // ---- Egypt ---------------------------------------------------------------
    ['name' => 'Ministry of Health and Population (Egypt)', 'sector' => 'government', 'region' => 'Egypt', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Ministry of Education and Technical Education (Egypt)', 'sector' => 'government', 'region' => 'Egypt', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],
    ['name' => 'Central Agency for Public Mobilization and Statistics', 'sector' => 'government', 'region' => 'Egypt', 'families' => ['finance', 'ict', 'public_admin']],
    ['name' => 'Egyptian Red Crescent', 'sector' => 'ngo', 'region' => 'Egypt', 'families' => ['health', 'social', 'business']],
    ['name' => 'National Bank of Egypt', 'sector' => 'private', 'region' => 'Egypt', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Commercial International Bank (CIB)', 'sector' => 'private', 'region' => 'Egypt', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Telecom Egypt', 'sector' => 'private', 'region' => 'Egypt', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],

    ['name' => 'Ministry of Agriculture and Land Reclamation (Egypt)', 'sector' => 'government', 'region' => 'Egypt', 'families' => ['agriculture', 'engineering', 'public_admin', 'finance']],

    // ---- Sudan ---------------------------------------------------------------
    ['name' => 'Federal Ministry of Health (Sudan)', 'sector' => 'government', 'region' => 'Sudan', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Ministry of Finance and Economic Planning (Sudan)', 'sector' => 'government', 'region' => 'Sudan', 'families' => ['finance', 'business', 'public_admin', 'ict', 'law']],
    ['name' => 'Khartoum State Government', 'sector' => 'government', 'region' => 'Sudan'],
    ['name' => 'Sudanese Red Crescent Society', 'sector' => 'ngo', 'region' => 'Sudan', 'families' => ['health', 'social', 'business']],
    ['name' => 'Bank of Khartoum', 'sector' => 'private', 'region' => 'Sudan', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Zain Sudan', 'sector' => 'private', 'region' => 'Sudan', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],

    ['name' => 'Ministry of Agriculture and Forestry (Sudan)', 'sector' => 'government', 'region' => 'Sudan', 'families' => ['agriculture', 'engineering', 'public_admin', 'finance']],
    ['name' => 'Ministry of Education (Sudan)', 'sector' => 'government', 'region' => 'Sudan', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],

    // ---- Morocco -------------------------------------------------------------
    ['name' => 'Ministry of Health and Social Protection (Morocco)', 'sector' => 'government', 'region' => 'Morocco', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Ministry of National Education (Morocco)', 'sector' => 'government', 'region' => 'Morocco', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],
    ['name' => 'High Commission for Planning', 'sector' => 'government', 'region' => 'Morocco', 'families' => ['public_admin', 'finance', 'social', 'ict']],
    ['name' => 'Moroccan Red Crescent', 'sector' => 'ngo', 'region' => 'Morocco', 'families' => ['health', 'social', 'business']],
    ['name' => 'Attijariwafa Bank', 'sector' => 'private', 'region' => 'Morocco', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Maroc Telecom', 'sector' => 'private', 'region' => 'Morocco', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],
    ['name' => 'OCP Group', 'sector' => 'private', 'region' => 'Morocco', 'families' => ['engineering', 'business', 'finance', 'ict', 'health', 'law']],

    ['name' => 'Ministry of Agriculture, Fisheries, Rural Development and Water and Forests (Morocco)', 'sector' => 'government', 'region' => 'Morocco', 'families' => ['agriculture', 'engineering', 'public_admin', 'finance']],

    // ---- Iraq ----------------------------------------------------------------
    ['name' => 'Ministry of Health (Iraq)', 'sector' => 'government', 'region' => 'Iraq', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Ministry of Planning (Iraq)', 'sector' => 'government', 'region' => 'Iraq', 'families' => ['public_admin', 'finance', 'social', 'ict']],
    ['name' => 'Mayoralty of Baghdad', 'sector' => 'government', 'region' => 'Iraq', 'families' => ['engineering', 'public_admin', 'finance', 'business', 'agriculture']],
    ['name' => 'Iraqi Red Crescent Society', 'sector' => 'ngo', 'region' => 'Iraq', 'families' => ['health', 'social', 'business']],
    ['name' => 'Asiacell', 'sector' => 'private', 'region' => 'Iraq', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],
    ['name' => 'Rafidain Bank', 'sector' => 'private', 'region' => 'Iraq', 'families' => ['finance', 'business', 'ict', 'law']],

    ['name' => 'Ministry of Education (Iraq)', 'sector' => 'government', 'region' => 'Iraq', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],

    // ---- Yemen ---------------------------------------------------------------
    ['name' => 'Ministry of Public Health and Population (Yemen)', 'sector' => 'government', 'region' => 'Yemen', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Social Fund for Development', 'sector' => 'government', 'region' => 'Yemen', 'families' => ['finance', 'public_admin', 'engineering', 'social']],
    ['name' => 'Yemen Red Crescent Society', 'sector' => 'ngo', 'region' => 'Yemen', 'families' => ['health', 'social', 'business']],
    ['name' => 'UNICEF Yemen', 'sector' => 'ngo', 'region' => 'Yemen', 'families' => ['health', 'education', 'social', 'public_admin', 'finance']],
    ['name' => 'Yemen Kuwait Bank', 'sector' => 'private', 'region' => 'Yemen', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Yemen Mobile', 'sector' => 'private', 'region' => 'Yemen', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],
    ['name' => 'Ministry of Agriculture and Irrigation (Yemen)', 'sector' => 'government', 'region' => 'Yemen', 'families' => ['agriculture', 'engineering', 'public_admin', 'finance']],
];
