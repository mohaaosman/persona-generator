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
    ['name' => 'Ministry of Finance', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Education, Culture and Higher Education', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Health and Human Services', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Planning, Investment and Economic Development', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Labour and Social Affairs', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Agriculture and Irrigation', 'sector' => 'government', 'region' => 'Lower Shabelle'],
    ['name' => 'Ministry of Interior, Federal Affairs and Reconciliation', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Justice and Constitutional Affairs', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Public Works, Reconstruction and Housing', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Communications and Technology', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Energy and Water Resources', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Fisheries and Marine Resources', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Livestock, Forestry and Range', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Ministry of Women and Human Rights Development', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Central Bank of Somalia', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'National Civil Service Commission', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Office of the Auditor General', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Somali National Bureau of Statistics', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'National Independent Electoral Commission', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Somali Disaster Management Agency', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Banadir Regional Administration', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Puntland State Government', 'sector' => 'government', 'region' => 'Nugaal'],
    ['name' => 'Jubaland State Government', 'sector' => 'government', 'region' => 'Lower Juba'],
    ['name' => 'South West State Government', 'sector' => 'government', 'region' => 'Bay'],
    ['name' => 'Hirshabelle State Government', 'sector' => 'government', 'region' => 'Hiiraan'],
    ['name' => 'Galmudug State Government', 'sector' => 'government', 'region' => 'Mudug'],
    ['name' => 'Somali Civil Aviation Authority', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'National Identification and Registration Authority', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Somali Customs Authority', 'sector' => 'government', 'region' => 'Banaadir'],
    ['name' => 'Mogadishu Port Authority', 'sector' => 'government', 'region' => 'Banaadir'],

    // ---- NGOs / international organisations ---------------------------------
    ['name' => 'UNICEF Somalia', 'sector' => 'ngo', 'region' => 'Banaadir'],
    ['name' => 'Save the Children Somalia', 'sector' => 'ngo', 'region' => 'Woqooyi Galbeed'],
    ['name' => 'Somali Red Crescent Society', 'sector' => 'ngo', 'region' => 'Nugaal'],
    ['name' => 'World Food Programme Somalia', 'sector' => 'ngo', 'region' => 'Banaadir'],
    ['name' => 'Norwegian Refugee Council', 'sector' => 'ngo', 'region' => 'Banaadir'],
    ['name' => 'Danish Refugee Council', 'sector' => 'ngo', 'region' => 'Gedo'],
    ['name' => 'Concern Worldwide Somalia', 'sector' => 'ngo', 'region' => 'Bay'],
    ['name' => 'Mercy Corps Somalia', 'sector' => 'ngo', 'region' => 'Mudug'],
    ['name' => 'CARE Somalia', 'sector' => 'ngo', 'region' => 'Woqooyi Galbeed'],
    ['name' => 'World Vision Somalia', 'sector' => 'ngo', 'region' => 'Lower Juba'],
    ['name' => 'SOS Children\'s Villages Somalia', 'sector' => 'ngo', 'region' => 'Banaadir'],
    ['name' => 'Wamo Relief and Rehabilitation Services', 'sector' => 'ngo', 'region' => 'Lower Juba'],
    ['name' => 'Juba Foundation', 'sector' => 'ngo', 'region' => 'Gedo'],
    ['name' => 'African Development Solutions (Adeso)', 'sector' => 'ngo', 'region' => 'Banaadir'],

    // ---- Private sector ----------------------------------------------------
    ['name' => 'Hormuud Telecom', 'sector' => 'private', 'region' => 'Banaadir'],
    ['name' => 'Salaam Somali Bank', 'sector' => 'private', 'region' => 'Banaadir'],
    ['name' => 'Premier Bank', 'sector' => 'private', 'region' => 'Banaadir'],
    ['name' => 'Dahabshiil Group', 'sector' => 'private', 'region' => 'Woqooyi Galbeed'],
    ['name' => 'Amal Bank', 'sector' => 'private', 'region' => 'Banaadir'],
    ['name' => 'Somtel', 'sector' => 'private', 'region' => 'Woqooyi Galbeed'],
    ['name' => 'Golis Telecom', 'sector' => 'private', 'region' => 'Bari'],
    ['name' => 'Coca-Cola Beverages Somalia (SBI)', 'sector' => 'private', 'region' => 'Banaadir'],
    ['name' => 'Trans-National Industrial Electricity (BECO)', 'sector' => 'private', 'region' => 'Banaadir'],
    ['name' => 'Kaah Express Financial Services', 'sector' => 'private', 'region' => 'Banaadir'],
];
