<?php

/*
 * Job titles grouped by career family, then by seniority tier. A persona's
 * field of study maps to a family (see fields.php), and the TimelineBuilder
 * escalates that family's ladder (junior -> mid -> senior) across successive
 * positions. Each role carries an English (en) and Somali (so) label.
 *
 * The 'public_admin' family also serves as the default ladder when a field's
 * family is not found here.
 */

return [

    'public_admin' => [
        'junior' => [
            ['en' => 'Administrative Assistant', 'so' => 'Kaaliye Maamul'],
            ['en' => 'Programme Officer', 'so' => 'Sarkaal Barnaamij'],
            ['en' => 'Field Officer', 'so' => 'Sarkaal Goob'],
            ['en' => 'Project Assistant', 'so' => 'Kaaliye Mashruuc'],
        ],
        'mid' => [
            ['en' => 'Senior Programme Officer', 'so' => 'Sarkaal Sare Barnaamij'],
            ['en' => 'Project Coordinator', 'so' => 'Isuduwe Mashruuc'],
            ['en' => 'Monitoring and Evaluation Officer', 'so' => 'Sarkaal La-socod iyo Qiimayn'],
            ['en' => 'Public Relations Officer', 'so' => 'Sarkaal Xiriirka Dadweynaha'],
        ],
        'senior' => [
            ['en' => 'Department Director', 'so' => 'Agaasimaha Waaxda'],
            ['en' => 'Policy Advisor', 'so' => 'La-taliye Siyaasadeed'],
            ['en' => 'Director General', 'so' => 'Agaasime Guud'],
            ['en' => 'Programme Manager', 'so' => 'Maareeyaha Barnaamijka'],
        ],
    ],

    'finance' => [
        'junior' => [
            ['en' => 'Finance Officer', 'so' => 'Sarkaal Maaliyadeed'],
            ['en' => 'Accounts Assistant', 'so' => 'Kaaliye Xisaabaad'],
            ['en' => 'Budget Officer', 'so' => 'Sarkaal Miisaaniyad'],
            ['en' => 'Data and Statistics Clerk', 'so' => 'Karaani Xog iyo Tirakoob'],
        ],
        'mid' => [
            ['en' => 'Senior Accountant', 'so' => 'Xisaabiye Sare'],
            ['en' => 'Financial Analyst', 'so' => 'Falanqeeye Maaliyadeed'],
            ['en' => 'Internal Auditor', 'so' => 'Hanti-dhowre Gudaha'],
            ['en' => 'Economist', 'so' => 'Dhaqaale-yaqaan'],
        ],
        'senior' => [
            ['en' => 'Head of Finance', 'so' => 'Madaxa Maaliyadda'],
            ['en' => 'Chief Accountant', 'so' => 'Xisaabiyaha Guud'],
            ['en' => 'Director of Budget and Treasury', 'so' => 'Agaasimaha Miisaaniyadda iyo Khasnadda'],
            ['en' => 'Chief Economist', 'so' => 'Dhaqaale-yaqaanka Guud'],
        ],
    ],

    'business' => [
        'junior' => [
            ['en' => 'Procurement Assistant', 'so' => 'Kaaliye Wax-iibsi'],
            ['en' => 'Human Resources Officer', 'so' => 'Sarkaal Shaqaale'],
            ['en' => 'Logistics Officer', 'so' => 'Sarkaal Saad'],
            ['en' => 'Business Development Officer', 'so' => 'Sarkaal Horumarinta Ganacsiga'],
        ],
        'mid' => [
            ['en' => 'Procurement Specialist', 'so' => 'Khabiir Wax-iibsi'],
            ['en' => 'Operations Manager', 'so' => 'Maareeyaha Hawlgalka'],
            ['en' => 'Human Resources Manager', 'so' => 'Maareeyaha Shaqaalaha'],
            ['en' => 'Supply Chain Coordinator', 'so' => 'Isuduwe Silsiladda Saadka'],
        ],
        'senior' => [
            ['en' => 'Director of Administration', 'so' => 'Agaasimaha Maamulka'],
            ['en' => 'Head of Procurement', 'so' => 'Madaxa Wax-iibsiga'],
            ['en' => 'Chief Operations Officer', 'so' => 'Madaxa Guud ee Hawlgalka'],
            ['en' => 'Director of Human Resources', 'so' => 'Agaasimaha Shaqaalaha'],
        ],
    ],

    'law' => [
        'junior' => [
            ['en' => 'Legal Assistant', 'so' => 'Kaaliye Sharci'],
            ['en' => 'Legal Officer', 'so' => 'Sarkaal Sharci'],
            ['en' => 'Paralegal', 'so' => 'Kaaliye Garsoor'],
            ['en' => 'Compliance Officer', 'so' => 'Sarkaal Hubinta Sharciga'],
        ],
        'mid' => [
            ['en' => 'Legal Counsel', 'so' => 'La-taliye Sharci'],
            ['en' => 'Public Prosecutor', 'so' => 'Xeer-ilaaliye'],
            ['en' => 'Senior Legal Advisor', 'so' => 'La-taliye Sare Sharci'],
            ['en' => 'Magistrate', 'so' => 'Qaadi'],
        ],
        'senior' => [
            ['en' => 'Director of Legal Affairs', 'so' => 'Agaasimaha Arrimaha Sharciga'],
            ['en' => 'Chief Legal Counsel', 'so' => 'La-taliyaha Guud ee Sharciga'],
            ['en' => 'Judge', 'so' => 'Garsoore'],
            ['en' => 'Attorney General Advisor', 'so' => 'La-taliyaha Xeer-ilaaliyaha Guud'],
        ],
    ],

    'engineering' => [
        'junior' => [
            ['en' => 'Site Engineer', 'so' => 'Injineer Goob'],
            ['en' => 'Junior Civil Engineer', 'so' => 'Injineer Dhisme Bilow'],
            ['en' => 'Design Assistant', 'so' => 'Kaaliye Naqshadeyn'],
            ['en' => 'Maintenance Officer', 'so' => 'Sarkaal Dayactir'],
        ],
        'mid' => [
            ['en' => 'Project Engineer', 'so' => 'Injineer Mashruuc'],
            ['en' => 'Structural Engineer', 'so' => 'Injineer Qaab-dhismeed'],
            ['en' => 'Site Manager', 'so' => 'Maareeyaha Goobta'],
            ['en' => 'Quality Control Engineer', 'so' => 'Injineer Tayo-hubin'],
        ],
        'senior' => [
            ['en' => 'Chief Engineer', 'so' => 'Injineerka Guud'],
            ['en' => 'Director of Public Works', 'so' => 'Agaasimaha Hawlaha Guud'],
            ['en' => 'Head of Infrastructure', 'so' => 'Madaxa Kaabayaasha'],
            ['en' => 'Project Director', 'so' => 'Agaasimaha Mashruuca'],
        ],
    ],

    'ict' => [
        'junior' => [
            ['en' => 'IT Support Officer', 'so' => 'Sarkaal Taageero IT'],
            ['en' => 'Software Developer', 'so' => 'Horumariye Barnaamij'],
            ['en' => 'Network Technician', 'so' => 'Farsamayaqaan Shabakad'],
            ['en' => 'Database Assistant', 'so' => 'Kaaliye Kayd-xog'],
        ],
        'mid' => [
            ['en' => 'Systems Analyst', 'so' => 'Falanqeeye Nidaamyo'],
            ['en' => 'Network Administrator', 'so' => 'Maamulaha Shabakadda'],
            ['en' => 'Senior Software Engineer', 'so' => 'Injineer Sare Barnaamij'],
            ['en' => 'ICT Coordinator', 'so' => 'Isuduwe Tignoolajiyada'],
        ],
        'senior' => [
            ['en' => 'Head of ICT', 'so' => 'Madaxa Tignoolajiyada'],
            ['en' => 'IT Director', 'so' => 'Agaasimaha IT'],
            ['en' => 'Chief Technology Officer', 'so' => 'Agaasimaha Guud ee Tignoolajiyada'],
            ['en' => 'Director of Digital Services', 'so' => 'Agaasimaha Adeegyada Dhijitaalka'],
        ],
    ],

    'health' => [
        'junior' => [
            ['en' => 'Registered Nurse', 'so' => 'Kalkaaliye Caafimaad Diiwaangashan'],
            ['en' => 'Medical Officer', 'so' => 'Sarkaal Caafimaad'],
            ['en' => 'Pharmacist', 'so' => 'Farmashiiste'],
            ['en' => 'Community Health Worker', 'so' => 'Shaqaale Caafimaadka Bulshada'],
        ],
        'mid' => [
            ['en' => 'Clinical Officer', 'so' => 'Sarkaal Kiliinig'],
            ['en' => 'Public Health Specialist', 'so' => 'Khabiir Caafimaadka Bulshada'],
            ['en' => 'Hospital Supervisor', 'so' => 'Kormeeraha Isbitaalka'],
            ['en' => 'Epidemiologist', 'so' => 'Khabiir Cudur-baadhis'],
        ],
        'senior' => [
            ['en' => 'Medical Director', 'so' => 'Agaasimaha Caafimaadka'],
            ['en' => 'Hospital Director', 'so' => 'Agaasimaha Isbitaalka'],
            ['en' => 'Head of Public Health', 'so' => 'Madaxa Caafimaadka Bulshada'],
            ['en' => 'Chief Medical Officer', 'so' => 'Sarkaalka Guud ee Caafimaadka'],
        ],
    ],

    'education' => [
        'junior' => [
            ['en' => 'Teacher', 'so' => 'Macallin'],
            ['en' => 'Teaching Assistant', 'so' => 'Kaaliye Macallin'],
            ['en' => 'Education Officer', 'so' => 'Sarkaal Waxbarasho'],
            ['en' => 'Curriculum Assistant', 'so' => 'Kaaliye Manhaj'],
        ],
        'mid' => [
            ['en' => 'Senior Teacher', 'so' => 'Macallin Sare'],
            ['en' => 'Curriculum Developer', 'so' => 'Horumariye Manhaj'],
            ['en' => 'School Principal', 'so' => 'Maamulaha Dugsiga'],
            ['en' => 'Education Coordinator', 'so' => 'Isuduwe Waxbarasho'],
        ],
        'senior' => [
            ['en' => 'Director of Education', 'so' => 'Agaasimaha Waxbarashada'],
            ['en' => 'Head of Curriculum', 'so' => 'Madaxa Manhajka'],
            ['en' => 'Regional Education Officer', 'so' => 'Sarkaalka Waxbarashada Gobolka'],
            ['en' => 'Dean of Studies', 'so' => 'Madaxa Kulliyadda'],
        ],
    ],

    'agriculture' => [
        'junior' => [
            ['en' => 'Agricultural Extension Officer', 'so' => 'Sarkaal Faafinta Beeraha'],
            ['en' => 'Field Agronomist', 'so' => 'Khabiir Beero Goob'],
            ['en' => 'Veterinary Assistant', 'so' => 'Kaaliye Xoolo-dhaqato'],
            ['en' => 'Fisheries Officer', 'so' => 'Sarkaal Kalluumeysi'],
        ],
        'mid' => [
            ['en' => 'Agronomist', 'so' => 'Khabiir Beeraha'],
            ['en' => 'Veterinary Officer', 'so' => 'Sarkaal Caafimaadka Xoolaha'],
            ['en' => 'Natural Resources Officer', 'so' => 'Sarkaal Kheyraadka Dabiiciga'],
            ['en' => 'Livestock Specialist', 'so' => 'Khabiir Xoolo-dhaqato'],
        ],
        'senior' => [
            ['en' => 'Director of Agriculture', 'so' => 'Agaasimaha Beeraha'],
            ['en' => 'Head of Livestock Services', 'so' => 'Madaxa Adeegyada Xoolaha'],
            ['en' => 'Director of Fisheries', 'so' => 'Agaasimaha Kalluumeysiga'],
            ['en' => 'Head of Environment', 'so' => 'Madaxa Deegaanka'],
        ],
    ],

    'social' => [
        'junior' => [
            ['en' => 'Social Worker', 'so' => 'Shaqaale Bulsho'],
            ['en' => 'Community Mobiliser', 'so' => 'Dhaqaajiye Bulsho'],
            ['en' => 'Protection Officer', 'so' => 'Sarkaal Ilaalin'],
            ['en' => 'Outreach Officer', 'so' => 'Sarkaal Gaarsiin'],
        ],
        'mid' => [
            ['en' => 'Programme Officer', 'so' => 'Sarkaal Barnaamij'],
            ['en' => 'Case Management Officer', 'so' => 'Sarkaal Maaraynta Kiisaska'],
            ['en' => 'Humanitarian Coordinator', 'so' => 'Isuduwe Bani-aadannimo'],
            ['en' => 'Gender and Inclusion Officer', 'so' => 'Sarkaal Jinsiga iyo Ka-qaybgalka'],
        ],
        'senior' => [
            ['en' => 'Director of Social Affairs', 'so' => 'Agaasimaha Arrimaha Bulshada'],
            ['en' => 'Head of Programmes', 'so' => 'Madaxa Barnaamijyada'],
            ['en' => 'Protection Cluster Lead', 'so' => 'Hoggaamiyaha Kooxda Ilaalinta'],
            ['en' => 'Director of Development', 'so' => 'Agaasimaha Horumarinta'],
        ],
    ],

];
