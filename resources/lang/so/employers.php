<?php

/*
 * Employers with a `sector` (government | ngo | private) and a region hint used
 * to locate the position. The TimelineBuilder weights selection toward the
 * public sector (see TimelineBuilder::SECTOR_WEIGHTS) to match the platform's
 * civil-service recruitment context, while still drawing the occasional NGO or
 * private-sector employer for realistic variety.
 */

return [

    // ---- Government: federal ministries & agencies -------------------------
    ['name' => 'Ministry of Finance', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['finance', 'business', 'public_admin', 'ict', 'law']],
    ['name' => 'Ministry of Education, Culture and Higher Education', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['education', 'public_admin', 'finance', 'business', 'ict']],
    ['name' => 'Ministry of Health and Human Services', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['health', 'public_admin', 'finance', 'business', 'ict', 'social']],
    ['name' => 'Ministry of Planning, Investment and Economic Development', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['public_admin', 'finance', 'social', 'ict']],
    ['name' => 'Ministry of Labour and Social Affairs', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['social', 'public_admin', 'law', 'business']],
    ['name' => 'Ministry of Agriculture and Irrigation', 'sector' => 'government', 'region' => 'Lower Shabelle', 'families' => ['agriculture', 'engineering', 'public_admin', 'finance']],
    ['name' => 'Ministry of Interior, Federal Affairs and Reconciliation', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['public_admin', 'law', 'ict', 'finance']],
    ['name' => 'Ministry of Justice and Constitutional Affairs', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['law', 'public_admin', 'finance']],
    ['name' => 'Ministry of Public Works, Reconstruction and Housing', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['engineering', 'public_admin', 'finance', 'business', 'agriculture']],
    ['name' => 'Ministry of Communications and Technology', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['ict', 'engineering', 'public_admin']],
    ['name' => 'Ministry of Energy and Water Resources', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['engineering', 'agriculture', 'public_admin', 'finance']],
    ['name' => 'Ministry of Fisheries and Marine Resources', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['agriculture', 'public_admin', 'finance']],
    ['name' => 'Ministry of Livestock, Forestry and Range', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['agriculture', 'public_admin']],
    ['name' => 'Ministry of Women and Human Rights Development', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['social', 'law', 'public_admin']],
    ['name' => 'Central Bank of Somalia', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['finance', 'law', 'ict', 'business']],
    ['name' => 'National Civil Service Commission', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['public_admin', 'business', 'law', 'ict']],
    ['name' => 'Office of the Auditor General', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['finance', 'law']],
    ['name' => 'Somali National Bureau of Statistics', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['finance', 'ict', 'public_admin']],
    ['name' => 'National Independent Electoral Commission', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['public_admin', 'law', 'ict']],
    ['name' => 'Somali Disaster Management Agency', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['social', 'public_admin', 'health', 'engineering']],
    ['name' => 'Banadir Regional Administration', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Puntland State Government', 'sector' => 'government', 'region' => 'Nugaal'],
    ['name' => 'Jubaland State Government', 'sector' => 'government', 'region' => 'Lower Juba'],
    ['name' => 'South West State Government', 'sector' => 'government', 'region' => 'Bay'],
    ['name' => 'Hirshabelle State Government', 'sector' => 'government', 'region' => 'Hiiraan'],
    ['name' => 'Galmudug State Government', 'sector' => 'government', 'region' => 'Mudug'],
    ['name' => 'Somali Civil Aviation Authority', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['engineering', 'ict', 'business', 'public_admin']],
    ['name' => 'National Identification and Registration Authority', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['ict', 'public_admin', 'law']],
    ['name' => 'Somali Customs Authority', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['finance', 'law', 'business']],
    ['name' => 'Mogadishu Port Authority', 'sector' => 'government', 'region' => 'Banaadir', 'families' => ['business', 'engineering', 'finance']],

    // ---- NGOs / international organisations ---------------------------------
    ['name' => 'UNICEF Somalia', 'sector' => 'ngo', 'region' => 'Banaadir', 'families' => ['health', 'education', 'social', 'public_admin', 'finance']],
    ['name' => 'Save the Children Somalia', 'sector' => 'ngo', 'region' => 'Woqooyi Galbeed', 'families' => ['education', 'health', 'social']],
    ['name' => 'Somali Red Crescent Society', 'sector' => 'ngo', 'region' => 'Nugaal', 'families' => ['health', 'social', 'business']],
    ['name' => 'World Food Programme Somalia', 'sector' => 'ngo', 'region' => 'Banaadir', 'families' => ['agriculture', 'business', 'social', 'finance']],
    ['name' => 'Norwegian Refugee Council', 'sector' => 'ngo', 'region' => 'Banaadir', 'families' => ['social', 'law', 'education', 'engineering', 'business']],
    ['name' => 'Danish Refugee Council', 'sector' => 'ngo', 'region' => 'Gedo', 'families' => ['social', 'law', 'education', 'engineering', 'business']],
    ['name' => 'Concern Worldwide Somalia', 'sector' => 'ngo', 'region' => 'Bay', 'families' => ['social', 'agriculture', 'health', 'education', 'finance']],
    ['name' => 'Mercy Corps Somalia', 'sector' => 'ngo', 'region' => 'Mudug', 'families' => ['social', 'agriculture', 'health', 'education', 'finance']],
    ['name' => 'CARE Somalia', 'sector' => 'ngo', 'region' => 'Woqooyi Galbeed', 'families' => ['social', 'agriculture', 'health', 'education', 'finance']],
    ['name' => 'World Vision Somalia', 'sector' => 'ngo', 'region' => 'Lower Juba', 'families' => ['education', 'health', 'social']],
    ['name' => 'SOS Children\'s Villages Somalia', 'sector' => 'ngo', 'region' => 'Banaadir', 'families' => ['education', 'health', 'social']],
    ['name' => 'Wamo Relief and Rehabilitation Services', 'sector' => 'ngo', 'region' => 'Lower Juba', 'families' => ['social', 'agriculture', 'health', 'education', 'finance']],
    ['name' => 'Juba Foundation', 'sector' => 'ngo', 'region' => 'Gedo', 'families' => ['social', 'agriculture', 'health', 'education', 'finance']],
    ['name' => 'African Development Solutions (Adeso)', 'sector' => 'ngo', 'region' => 'Banaadir', 'families' => ['social', 'agriculture', 'health', 'education', 'finance']],

    // ---- Private sector ----------------------------------------------------
    ['name' => 'Hormuud Telecom', 'sector' => 'private', 'region' => 'Banaadir', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],
    ['name' => 'Salaam Somali Bank', 'sector' => 'private', 'region' => 'Banaadir', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Premier Bank', 'sector' => 'private', 'region' => 'Banaadir', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Dahabshiil Group', 'sector' => 'private', 'region' => 'Woqooyi Galbeed', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Amal Bank', 'sector' => 'private', 'region' => 'Banaadir', 'families' => ['finance', 'business', 'ict', 'law']],
    ['name' => 'Somtel', 'sector' => 'private', 'region' => 'Woqooyi Galbeed', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],
    ['name' => 'Golis Telecom', 'sector' => 'private', 'region' => 'Bari', 'families' => ['ict', 'business', 'finance', 'engineering', 'law']],
    ['name' => 'Coca-Cola Beverages Somalia (SBI)', 'sector' => 'private', 'region' => 'Banaadir', 'families' => ['business', 'finance', 'engineering']],
    ['name' => 'Trans-National Industrial Electricity (BECO)', 'sector' => 'private', 'region' => 'Banaadir', 'families' => ['engineering', 'business', 'finance']],
    ['name' => 'Kaah Express Financial Services', 'sector' => 'private', 'region' => 'Banaadir', 'families' => ['finance', 'business', 'ict', 'law']],
];
