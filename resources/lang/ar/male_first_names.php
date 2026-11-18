<?php

/*
 * Arabic male given names, in common English transliteration, sorted
 * alphabetically. Spelling variants that reflect real regional usage are kept
 * on purpose (Gulf "Mohammed", Egyptian "Mohamed", Maghrebi "Abdelkader",
 * Sudanese "Yousif") — national registries spell the same name many ways.
 *
 * Like the Somali locale, this pool also supplies every persona's MIDDLE
 * (father's) and LAST (grandfather's) name. The generator builds a three-part
 * patronymic chain — "<own> <father> <grandfather>" — and never invents a
 * family name / tribal "Al-" surname.
 *
 * Rules: one given name per entry (no "Abu Bakr" style two-word entries, no
 * theophoric compounds split with a space), real names only, and disjoint
 * from female_first_names.php.
 */

return [
    'Abbas', 'Abdelaziz', 'Abdelfattah', 'Abdelghani', 'Abdelhak', 'Abdelhamid',
    'Abdelilah', 'Abdelkader', 'Abdelkarim', 'Abdellah', 'Abdellatif',
    'Abdelmajid', 'Abdelmalek', 'Abdelmonem', 'Abdelnasser', 'Abdelrahim',
    'Abdelrahman', 'Abderrahim', 'Abderrahmane', 'Abdulaziz', 'Abdulbari',
    'Abdulbasit', 'Abdulelah', 'Abdulghani', 'Abdulhadi', 'Abdulhafiz',
    'Abdulhakim', 'Abdulhamid', 'Abdulilah', 'Abduljalil', 'Abdulkareem',
    'Abdulkarim', 'Abdulkhaliq', 'Abdulla', 'Abdullah', 'Abdullatif',
    'Abdulmajeed', 'Abdulmajid', 'Abdulmalik', 'Abdulmohsen', 'Abdulmonem',
    'Abdulmuhsin', 'Abdulnasser', 'Abdulqader', 'Abdulrahim', 'Abdulrahman',
    'Abdulrashid', 'Abdulrazzaq', 'Abdulsalam', 'Abdulsattar', 'Abdulwahab',
    'Abdulwahid', 'Abdussamad', 'Abubakr', 'Adam', 'Adel', 'Adil', 'Adnan',
    'Ahmad', 'Ahmed', 'Akram', 'Alaa', 'Ali', 'Ameer', 'Amer', 'Amine', 'Amir',
    'Ammar', 'Amr', 'Anas', 'Anouar', 'Anwar', 'Ashraf', 'Asim', 'Assem',
    'Atef', 'Awad', 'Ayham', 'Ayman', 'Aymen', 'Ayoub', 'Aziz', 'Babiker',
    'Bader', 'Badr', 'Bakr', 'Bandar', 'Basel', 'Bashar', 'Bashir', 'Basil',
    'Bassam', 'Bilal', 'Brahim', 'Burhan', 'Dawood', 'Dawoud', 'Djamel',
    'Driss', 'Ehab', 'Eissa', 'Emad', 'Essam', 'Ezzeldin', 'Fadel', 'Fadi',
    'Fadil', 'Fahad', 'Fahd', 'Faisal', 'Faleh', 'Fares', 'Farid', 'Faris',
    'Farouk', 'Farouq', 'Fathi', 'Fathy', 'Fawaz', 'Fawzi', 'Fouad', 'Fuad',
    'Gamal', 'Gamil', 'Ghaleb', 'Ghalib', 'Ghanem', 'Ghanim', 'Ghassan',
    'Ghazi', 'Habib', 'Hadi', 'Haidar', 'Haitham', 'Hakim', 'Hamad', 'Hamdan',
    'Hamdi', 'Hamdy', 'Hamed', 'Hamid', 'Hammam', 'Hamza', 'Hamzah', 'Hani',
    'Hany', 'Harith', 'Hasan', 'Hassan', 'Hatem', 'Hatim', 'Hayder', 'Haytham',
    'Hazem', 'Hazza', 'Helmy', 'Hesham', 'Hicham', 'Hilal', 'Hisham', 'Hocine',
    'Hosni', 'Hossam', 'Hudhaifa', 'Humaid', 'Husam', 'Hussain', 'Hussam',
    'Hussein', 'Ibrahim', 'Idris', 'Idriss', 'Ihab', 'Ilyas', 'Imad', 'Imran',
    'Isa', 'Ismail', 'Issa', 'Issam', 'Iyad', 'Jaafar', 'Jaber', 'Jabir', 'Jad',
    'Jafar', 'Jalal', 'Jamal', 'Jameel', 'Jamil', 'Jasim', 'Jassim', 'Jawad',
    'Jihad', 'Juma', 'Kadhim', 'Kamal', 'Kamel', 'Kamil', 'Karam', 'Kareem',
    'Karim', 'Kazem', 'Kenan', 'Khaldoun', 'Khaled', 'Khalid', 'Khalifa',
    'Khalil', 'Khattab', 'Lahcen', 'Laith', 'Layth', 'Lotfi', 'Louay', 'Luay',
    'Luqman', 'Lutfi', 'Magdy', 'Maged', 'Mahdi', 'Maher', 'Mahmoud', 'Mahmud',
    'Majed', 'Majid', 'Malek', 'Malik', 'Mamdouh', 'Mamoun', 'Mansoor',
    'Mansour', 'Marwan', 'Mazen', 'Mazhar', 'Mazin', 'Medhat', 'Mehdi',
    'Meshal', 'Mishal', 'Mishari', 'Moataz', 'Moath', 'Moayad', 'Mohab',
    'Mohamed', 'Mohammed', 'Mohanad', 'Mohannad', 'Mohsen', 'Mokhtar',
    'Mostafa', 'Mounir', 'Mourad', 'Mousa', 'Moustafa', 'Muadh', 'Muath',
    'Muayad', 'Mubarak', 'Muhammad', 'Muhannad', 'Muhsin', 'Mujahid', 'Mukhtar',
    'Mundhir', 'Munir', 'Muntadhar', 'Munther', 'Murad', 'Musa', 'Musab',
    'Mustafa', 'Mustapha', 'Mutahar', 'Mutaib', 'Mutasim', 'Mutaz', 'Mutlaq',
    'Nabeel', 'Nabil', 'Nadeem', 'Nader', 'Nadim', 'Nadir', 'Nael', 'Naif',
    'Naji', 'Najib', 'Nashwan', 'Nasir', 'Nasreldin', 'Nasser', 'Nawaf',
    'Nayef', 'Nidal', 'Nizar', 'Nouh', 'Noureddine', 'Nouri', 'Nuh', 'Nuri',
    'Obaid', 'Omar', 'Omer', 'Omran', 'Osama', 'Osman', 'Othman', 'Othmane',
    'Oussama', 'Qahtan', 'Qais', 'Qasim', 'Qassem', 'Qays', 'Qusay', 'Raad',
    'Raafat', 'Rabea', 'Rabie', 'Rabih', 'Rachid', 'Radwan', 'Raed', 'Rafik',
    'Rafiq', 'Ragab', 'Raji', 'Rakan', 'Ramadan', 'Rami', 'Ramzi', 'Rashed',
    'Rashid', 'Rayan', 'Reda', 'Redouane', 'Riad', 'Rida', 'Ridwan', 'Riyad',
    'Riyadh', 'Saad', 'Saber', 'Sabir', 'Sabri', 'Sadek', 'Sadiq', 'Saeed',
    'Safwan', 'Sahl', 'Said', 'Saif', 'Sajjad', 'Salah', 'Saleh', 'Salem',
    'Salim', 'Sameer', 'Samer', 'Sami', 'Samir', 'Saqr', 'Sattam', 'Saud',
    'Sayed', 'Sayf', 'Seif', 'Shaaban', 'Shadi', 'Shady', 'Shaker', 'Shakir',
    'Shareef', 'Sharif', 'Shehab', 'Sherif', 'Shihab', 'Shukri', 'Siddig',
    'Sinan', 'Sofiane', 'Soufiane', 'Subhi', 'Sufyan', 'Suhaib', 'Suhail',
    'Sulaiman', 'Suleiman', 'Sultan', 'Taha', 'Taher', 'Tahir', 'Taieb',
    'Talal', 'Tamer', 'Tamim', 'Tarek', 'Tariq', 'Tawfik', 'Tawfiq', 'Tayeb',
    'Tayseer', 'Thamer', 'Thamir', 'Turki', 'Ubaid', 'Umar', 'Usaid', 'Usama',
    'Uthman', 'Wael', 'Wajdi', 'Waleed', 'Walid', 'Waseem', 'Wassim', 'Wisam',
    'Yacine', 'Yacoub', 'Yahya', 'Yamen', 'Yaqub', 'Yasir', 'Yasser', 'Yassine',
    'Yazan', 'Yazid', 'Yehia', 'Yousef', 'Yousif', 'Youssef', 'Yusuf', 'Zaid',
    'Zain', 'Zakaria', 'Zakariya', 'Zaki', 'Zayed', 'Zayn', 'Ziad', 'Ziyad',
    'Zubair', 'Zubayr', 'Zuhair', 'Zuhdi',
];
