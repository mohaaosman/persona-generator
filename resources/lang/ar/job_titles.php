<?php

/*
 * Job titles grouped by career family, then by seniority tier, with English
 * (en) and Arabic (ar) labels. Families mirror the Somali locale so a field of
 * study maps to the same kind of career. 'public_admin' is the fallback ladder.
 */

return [

    'public_admin' => [
        'junior' => [
            ['en' => 'Administrative Assistant', 'ar' => 'مساعد إداري'],
            ['en' => 'Programme Officer', 'ar' => 'مسؤول برامج'],
            ['en' => 'Field Officer', 'ar' => 'مسؤول ميداني'],
            ['en' => 'Project Assistant', 'ar' => 'مساعد مشروع'],
        ],
        'mid' => [
            ['en' => 'Senior Programme Officer', 'ar' => 'مسؤول برامج أول'],
            ['en' => 'Project Coordinator', 'ar' => 'منسق مشروع'],
            ['en' => 'Monitoring and Evaluation Officer', 'ar' => 'مسؤول الرصد والتقييم'],
            ['en' => 'Public Relations Officer', 'ar' => 'مسؤول العلاقات العامة'],
        ],
        'senior' => [
            ['en' => 'Department Director', 'ar' => 'مدير إدارة'],
            ['en' => 'Policy Advisor', 'ar' => 'مستشار سياسات'],
            ['en' => 'Director General', 'ar' => 'مدير عام'],
            ['en' => 'Programme Manager', 'ar' => 'مدير برامج'],
        ],
    ],

    'finance' => [
        'junior' => [
            ['en' => 'Finance Officer', 'ar' => 'موظف مالي'],
            ['en' => 'Accounts Assistant', 'ar' => 'مساعد محاسب'],
            ['en' => 'Budget Officer', 'ar' => 'مسؤول الميزانية'],
            ['en' => 'Data and Statistics Clerk', 'ar' => 'كاتب بيانات وإحصاء'],
        ],
        'mid' => [
            ['en' => 'Senior Accountant', 'ar' => 'محاسب أول'],
            ['en' => 'Financial Analyst', 'ar' => 'محلل مالي'],
            ['en' => 'Internal Auditor', 'ar' => 'مدقق داخلي'],
            ['en' => 'Economist', 'ar' => 'خبير اقتصادي'],
        ],
        'senior' => [
            ['en' => 'Head of Finance', 'ar' => 'رئيس الشؤون المالية'],
            ['en' => 'Chief Accountant', 'ar' => 'رئيس المحاسبين'],
            ['en' => 'Director of Budget and Treasury', 'ar' => 'مدير الميزانية والخزينة'],
            ['en' => 'Chief Economist', 'ar' => 'كبير الاقتصاديين'],
        ],
    ],

    'business' => [
        'junior' => [
            ['en' => 'Procurement Assistant', 'ar' => 'مساعد مشتريات'],
            ['en' => 'Human Resources Officer', 'ar' => 'موظف موارد بشرية'],
            ['en' => 'Logistics Officer', 'ar' => 'مسؤول لوجستي'],
            ['en' => 'Business Development Officer', 'ar' => 'مسؤول تطوير الأعمال'],
        ],
        'mid' => [
            ['en' => 'Procurement Specialist', 'ar' => 'أخصائي مشتريات'],
            ['en' => 'Operations Manager', 'ar' => 'مدير العمليات'],
            ['en' => 'Human Resources Manager', 'ar' => 'مدير الموارد البشرية'],
            ['en' => 'Supply Chain Coordinator', 'ar' => 'منسق سلسلة الإمداد'],
        ],
        'senior' => [
            ['en' => 'Director of Administration', 'ar' => 'مدير الشؤون الإدارية'],
            ['en' => 'Head of Procurement', 'ar' => 'رئيس المشتريات'],
            ['en' => 'Chief Operations Officer', 'ar' => 'الرئيس التنفيذي للعمليات'],
            ['en' => 'Director of Human Resources', 'ar' => 'مدير الموارد البشرية العام'],
        ],
    ],

    'law' => [
        'junior' => [
            ['en' => 'Legal Assistant', 'ar' => 'مساعد قانوني'],
            ['en' => 'Legal Officer', 'ar' => 'موظف قانوني'],
            ['en' => 'Paralegal', 'ar' => 'باحث قانوني'],
            ['en' => 'Compliance Officer', 'ar' => 'مسؤول الامتثال'],
        ],
        'mid' => [
            ['en' => 'Legal Counsel', 'ar' => 'مستشار قانوني'],
            ['en' => 'Public Prosecutor', 'ar' => 'وكيل نيابة'],
            ['en' => 'Senior Legal Advisor', 'ar' => 'مستشار قانوني أول'],
            ['en' => 'Magistrate', 'ar' => 'قاضي محكمة جزئية'],
        ],
        'senior' => [
            ['en' => 'Director of Legal Affairs', 'ar' => 'مدير الشؤون القانونية'],
            ['en' => 'Chief Legal Counsel', 'ar' => 'كبير المستشارين القانونيين'],
            ['en' => 'Judge', 'ar' => 'قاض'],
            ['en' => 'Attorney General Advisor', 'ar' => 'مستشار النائب العام'],
        ],
    ],

    'engineering' => [
        'junior' => [
            ['en' => 'Site Engineer', 'ar' => 'مهندس موقع'],
            ['en' => 'Junior Civil Engineer', 'ar' => 'مهندس مدني مبتدئ'],
            ['en' => 'Design Assistant', 'ar' => 'مساعد تصميم'],
            ['en' => 'Maintenance Officer', 'ar' => 'مسؤول صيانة'],
        ],
        'mid' => [
            ['en' => 'Project Engineer', 'ar' => 'مهندس مشاريع'],
            ['en' => 'Structural Engineer', 'ar' => 'مهندس إنشائي'],
            ['en' => 'Site Manager', 'ar' => 'مدير موقع'],
            ['en' => 'Quality Control Engineer', 'ar' => 'مهندس مراقبة الجودة'],
        ],
        'senior' => [
            ['en' => 'Chief Engineer', 'ar' => 'كبير المهندسين'],
            ['en' => 'Director of Public Works', 'ar' => 'مدير الأشغال العامة'],
            ['en' => 'Head of Infrastructure', 'ar' => 'رئيس البنية التحتية'],
            ['en' => 'Project Director', 'ar' => 'مدير المشروع'],
        ],
    ],

    'ict' => [
        'junior' => [
            ['en' => 'IT Support Officer', 'ar' => 'موظف دعم فني'],
            ['en' => 'Software Developer', 'ar' => 'مطور برمجيات'],
            ['en' => 'Network Technician', 'ar' => 'فني شبكات'],
            ['en' => 'Database Assistant', 'ar' => 'مساعد قواعد بيانات'],
        ],
        'mid' => [
            ['en' => 'Systems Analyst', 'ar' => 'محلل نظم'],
            ['en' => 'Network Administrator', 'ar' => 'مسؤول شبكات'],
            ['en' => 'Senior Software Engineer', 'ar' => 'مهندس برمجيات أول'],
            ['en' => 'ICT Coordinator', 'ar' => 'منسق تقنية المعلومات والاتصالات'],
        ],
        'senior' => [
            ['en' => 'Head of ICT', 'ar' => 'رئيس تقنية المعلومات والاتصالات'],
            ['en' => 'IT Director', 'ar' => 'مدير تقنية المعلومات'],
            ['en' => 'Chief Technology Officer', 'ar' => 'الرئيس التنفيذي للتقنية'],
            ['en' => 'Director of Digital Services', 'ar' => 'مدير الخدمات الرقمية'],
        ],
    ],

    'health' => [
        'junior' => [
            ['en' => 'Registered Nurse', 'ar' => 'ممرض مسجل'],
            ['en' => 'Medical Officer', 'ar' => 'طبيب عام'],
            ['en' => 'Pharmacist', 'ar' => 'صيدلي'],
            ['en' => 'Community Health Worker', 'ar' => 'عامل صحة مجتمعية'],
        ],
        'mid' => [
            ['en' => 'Clinical Officer', 'ar' => 'مسؤول سريري'],
            ['en' => 'Public Health Specialist', 'ar' => 'أخصائي صحة عامة'],
            ['en' => 'Hospital Supervisor', 'ar' => 'مشرف مستشفى'],
            ['en' => 'Epidemiologist', 'ar' => 'أخصائي وبائيات'],
        ],
        'senior' => [
            ['en' => 'Medical Director', 'ar' => 'المدير الطبي'],
            ['en' => 'Hospital Director', 'ar' => 'مدير مستشفى'],
            ['en' => 'Head of Public Health', 'ar' => 'رئيس الصحة العامة'],
            ['en' => 'Chief Medical Officer', 'ar' => 'كبير الأطباء'],
        ],
    ],

    'education' => [
        'junior' => [
            ['en' => 'Teacher', 'ar' => 'معلم'],
            ['en' => 'Teaching Assistant', 'ar' => 'مساعد تدريس'],
            ['en' => 'Education Officer', 'ar' => 'موظف تعليمي'],
            ['en' => 'Curriculum Assistant', 'ar' => 'مساعد مناهج'],
        ],
        'mid' => [
            ['en' => 'Senior Teacher', 'ar' => 'معلم أول'],
            ['en' => 'Curriculum Developer', 'ar' => 'مطور مناهج'],
            ['en' => 'School Principal', 'ar' => 'مدير مدرسة'],
            ['en' => 'Education Coordinator', 'ar' => 'منسق تعليمي'],
        ],
        'senior' => [
            ['en' => 'Director of Education', 'ar' => 'مدير التعليم'],
            ['en' => 'Head of Curriculum', 'ar' => 'رئيس المناهج'],
            ['en' => 'Regional Education Officer', 'ar' => 'مسؤول التعليم الإقليمي'],
            ['en' => 'Dean of Studies', 'ar' => 'عميد الدراسات'],
        ],
    ],

    'agriculture' => [
        'junior' => [
            ['en' => 'Agricultural Extension Officer', 'ar' => 'مرشد زراعي'],
            ['en' => 'Field Agronomist', 'ar' => 'مهندس زراعي ميداني'],
            ['en' => 'Veterinary Assistant', 'ar' => 'مساعد بيطري'],
            ['en' => 'Fisheries Officer', 'ar' => 'مسؤول الثروة السمكية'],
        ],
        'mid' => [
            ['en' => 'Agronomist', 'ar' => 'مهندس زراعي'],
            ['en' => 'Veterinary Officer', 'ar' => 'طبيب بيطري'],
            ['en' => 'Natural Resources Officer', 'ar' => 'مسؤول الموارد الطبيعية'],
            ['en' => 'Livestock Specialist', 'ar' => 'أخصائي ثروة حيوانية'],
        ],
        'senior' => [
            ['en' => 'Director of Agriculture', 'ar' => 'مدير الزراعة'],
            ['en' => 'Head of Livestock Services', 'ar' => 'رئيس خدمات الثروة الحيوانية'],
            ['en' => 'Director of Fisheries', 'ar' => 'مدير الثروة السمكية'],
            ['en' => 'Head of Environment', 'ar' => 'رئيس شؤون البيئة'],
        ],
    ],

    'social' => [
        'junior' => [
            ['en' => 'Social Worker', 'ar' => 'أخصائي اجتماعي'],
            ['en' => 'Community Mobiliser', 'ar' => 'محفز مجتمعي'],
            ['en' => 'Protection Officer', 'ar' => 'مسؤول حماية'],
            ['en' => 'Outreach Officer', 'ar' => 'مسؤول التواصل المجتمعي'],
        ],
        'mid' => [
            ['en' => 'Programme Officer', 'ar' => 'مسؤول برامج'],
            ['en' => 'Case Management Officer', 'ar' => 'مسؤول إدارة الحالات'],
            ['en' => 'Humanitarian Coordinator', 'ar' => 'منسق إنساني'],
            ['en' => 'Gender and Inclusion Officer', 'ar' => 'مسؤول النوع الاجتماعي والإدماج'],
        ],
        'senior' => [
            ['en' => 'Director of Social Affairs', 'ar' => 'مدير الشؤون الاجتماعية'],
            ['en' => 'Head of Programmes', 'ar' => 'رئيس البرامج'],
            ['en' => 'Protection Cluster Lead', 'ar' => 'قائد مجموعة الحماية'],
            ['en' => 'Director of Development', 'ar' => 'مدير التنمية'],
        ],
    ],

];
