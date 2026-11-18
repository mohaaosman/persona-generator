<?php

/*
 * Offline prose templates. Placeholders are interpolated by TemplateProseDriver
 * from persona facts. Available tokens:
 *   :first_name :full_name :role :organisation :years :degree :field
 *   :institution :languages :region :city :nationality :pronoun_subject
 *   :pronoun_possessive
 *
 * The `employment_description` block is consumed by TimelineBuilder (not the
 * prose driver) to vary each position's description. Its templates are bilingual
 * and gender-neutral (no Somali subject pronoun), with tokens :role
 * :organisation :region.
 */

return [

    'bio' => [
        ':first_name is a :field professional with :years years of experience, currently serving as :role at :organisation.',
        'A :institution graduate in :field, :first_name has spent :years years working across the public sector, most recently as :role at :organisation.',
        'With a background in :field and :years years in the field, :first_name brings hands-on experience as :role at :organisation.',
        ':first_name is a dedicated :field specialist based in :region, holding a :degree from :institution and working as :role at :organisation.',
        'Based in :region, :first_name is a :field professional whose :years-year career has culminated in the role of :role at :organisation.',
        ':first_name combines a :degree in :field from :institution with :years years of practical experience, currently as :role at :organisation.',
        'Now serving as :role at :organisation, :first_name has built :years years of experience in :field since graduating from :institution.',
        ':first_name is a results-oriented :field practitioner in :region, with :years years behind the role of :role at :organisation.',
        ':full_name is a :nationality :field professional living in :city, with :years years of experience and a current post as :role at :organisation.',
        'Born and raised in :region and now based in :city, :first_name holds a :degree in :field and works as :role at :organisation.',
    ],

    'bio_suffix' => [
        ' :pronoun_subject is fluent in :languages.',
        ' Languages: :languages.',
        ' :pronoun_subject works comfortably in :languages.',
        ' :pronoun_subject communicates with stakeholders in :languages.',
    ],

    'employment_description' => [
        'en' => [
            'Served as :role at :organisation, delivering core duties for the :region region.',
            ':role at :organisation, responsible for day-to-day operations across :region.',
            'Held the position of :role at :organisation, supporting its mandate in :region.',
            'Worked as :role within :organisation, coordinating activities in the :region region.',
            'As :role at :organisation, contributed to programme delivery and reporting in :region.',
        ],
        'so' => [
            'Jagada :role ee :organisation, oo gudanaya hawlaha aasaasiga ah ee gobolka :region.',
            ':role ka tirsan :organisation, mas\'uul ka ah hawlaha maalinlaha ah ee :region.',
            'Xilka :role ee :organisation, taageeraya hawlaha hay\'adda gobolka :region.',
            'Shaqaale :role ah oo ka tirsan :organisation, isuduwaya hawlaha gobolka :region.',
            'Ahaan jagada :role ee :organisation, ka qaybqaadanaya fulinta barnaamijyada :region.',
        ],
    ],

    'cover_letter' => [
        'intro' => [
            'Dear Hiring Committee,',
            'To the Recruitment Panel,',
            'Dear Selection Committee,',
        ],
        'experience' => [
            'I am writing to express my interest in the advertised position. Over the past :years years I have built my career in :field, most recently as :role at :organisation, where I delivered results under demanding conditions.',
            'I am pleased to submit my application. With :years years of experience in :field, including my current role as :role at :organisation, I have developed the practical skills this position requires.',
            'Please accept my application for this role. My :years years in :field, culminating in my current position as :role at :organisation, have prepared me to make an immediate contribution.',
        ],
        'education' => [
            'I hold a :degree in :field from :institution, which grounded me in both the theory and practice of my work.',
            'My :degree in :field from :institution gave me a strong foundation that I have applied throughout my career.',
            'Academically, my :degree in :field from :institution equipped me with the analytical tools I rely on daily.',
        ],
        'motivation' => [
            'I am motivated by the opportunity to contribute to the public service and to support the development goals of my community in :region. I work fluently in :languages, which lets me serve a wide range of stakeholders.',
            'Serving the institutions of my country is important to me, and I would welcome the chance to bring my experience to your team. I communicate effectively in :languages.',
            'What draws me to this role is the chance to advance public service delivery in :region. Working comfortably in :languages, I can engage effectively with the communities you serve.',
        ],
        'closing' => [
            'Thank you for considering my application. I would be glad to discuss how my experience fits your needs.',
            'I appreciate your time and consideration, and I look forward to the opportunity to contribute.',
            'Thank you for reviewing my application; I would welcome the opportunity to discuss it further.',
        ],
        'signature' => [
            'Sincerely,'."\n".':full_name',
            'Respectfully,'."\n".':full_name',
            'Yours faithfully,'."\n".':full_name',
        ],
    ],

];
