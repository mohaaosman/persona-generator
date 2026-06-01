<?php

/*
 * Offline prose templates. Placeholders are interpolated by TemplateProseDriver
 * from persona facts. Available tokens:
 *   :first_name :full_name :role :organisation :years :degree :field
 *   :institution :languages :region :pronoun_subject :pronoun_possessive
 */

return [

    'bio' => [
        ':first_name is a :field professional with :years years of experience, currently serving as :role at :organisation.',
        'A :institution graduate in :field, :first_name has spent :years years working across the public sector, most recently as :role at :organisation.',
        'With a background in :field and :years years in the field, :first_name brings hands-on experience as :role at :organisation.',
        ':first_name is a dedicated :field specialist based in :region, holding a :degree from :institution and working as :role at :organisation.',
    ],

    'bio_suffix' => [
        ' :pronoun_subject is fluent in :languages.',
        ' Languages: :languages.',
        ' :pronoun_subject works comfortably in :languages.',
    ],

    'cover_letter' => [
        'intro' => [
            'Dear Hiring Committee,',
            'To the Recruitment Panel,',
        ],
        'experience' => [
            'I am writing to express my interest in the advertised position. Over the past :years years I have built my career in :field, most recently as :role at :organisation, where I delivered results under demanding conditions.',
            'I am pleased to submit my application. With :years years of experience in :field, including my current role as :role at :organisation, I have developed the practical skills this position requires.',
        ],
        'education' => [
            'I hold a :degree in :field from :institution, which grounded me in both the theory and practice of my work.',
            'My :degree in :field from :institution gave me a strong foundation that I have applied throughout my career.',
        ],
        'motivation' => [
            'I am motivated by the opportunity to contribute to the public service and to support the development goals of my community in :region. I work fluently in :languages, which lets me serve a wide range of stakeholders.',
            'Serving the institutions of my country is important to me, and I would welcome the chance to bring my experience to your team. I communicate effectively in :languages.',
        ],
        'closing' => [
            'Thank you for considering my application. I would be glad to discuss how my experience fits your needs.',
            'I appreciate your time and consideration, and I look forward to the opportunity to contribute.',
        ],
        'signature' => [
            'Sincerely,'."\n".':full_name',
            'Respectfully,'."\n".':full_name',
        ],
    ],

];
