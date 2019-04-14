<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $masterAdventuresAerobicsData = [
        'Air Ballooning',
        'Bicycling',
        'Camping',
        'Climbing',
        'Dancing',
        'Gymnastics',
        'Hiking',
        'Horseback Riding',
        'Hunting',
        'Kayaking',
        'Martial Arts',
        'Paragliding',
        'Pilates',
        'Rafting',
        'Rollerblading',
        'Running',
        'Sailing',
        'Scuba Diving',
        'Skate Boarding',
        'Skiing',
        'Snorkeling',
        'Surf Boarding',
        'Tai-Chi',
        'Trekking',
        'Ultimate Frisbee',
        'Water Rafting',
        'Weightlifting',
        'Walking',
        'Wind Surfing',
        'Yacht Sailing',
        'Yoga'


        ];

        foreach ($masterAdventuresAerobicsData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Adventures & Aerobics',
                            'active' => 1,
                        ]);
        }


    $masterHobbyWithSkillData = [
        'Alternative Medicine',
        'Aromatherapy',
        'Art Collecting',
        'Astrology',
        'Beading',
        'Body Art',
        'Candle Making',
        'Cooking',
        'Cross-Stitching',
        'Drawing',
        'Gardening',
        'Herbalism',
        'Investing',
        'Karaoke',
        'Knitting',
        'Meditation',
        'Online Auctions',
        'Painting',
        'Photography',
        'Pottery',
        'Sculpting',
        'Sewing',
        'Singing',
        'Soap Making',
        'Tattoos'



        ];

        foreach ($masterHobbyWithSkillData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Hobby with Skill',
                            'active' => 1,
                        ]);
        }




 $masterIntellectualInterestsData = [
       'Archaeology',
        'Astronomy',
        'Biology',
        'Blogging',
        'Chemistry',
        'Conservative Politics',
        'Cryonics',
        'Economics',
        'History',
        'Intellectual Discourse',
        'Liberal Politics' ,
        'Libertarian Politics' ,
        'Mathematics',
        'Nanotechnology',
        'Nihilism',
        'Nutrition',
        'Occultism',
        'Paranormal',
        'Philosophy',
        'Physics',
        'Poetry',
        'Political Activism',
        'Psychology', 
        'Writing'




        ];

        foreach ($masterIntellectualInterestsData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Intellectual Interests',
                            'active' => 1,
                        ]);
        }




$masterMusicData = [
       'Alternative Music' ,
        'Americana',
        'Blue Grass',
        'Blues',
        'Classical Music',
        'Country Music',
        'Eighties Music',
        'Electronica / EDM',
        'EMO Music',
        'Folk Music',
        'Funk',
        'Heavy Metal Music',
        'Hip Hop Music',
        'Industrial Music',
        'Jazz',
        'New Age Music',
        'New Wave',
        'Nineties Music',
        'Oldies',
        'Opera',
        'Operetta',
        'Pop Music',
        'Punk Rock Music',
        'R&B',
        'Rap',
        'Reggae',
        'Rock Music',
        'Show Tunes',
        'Seventies Music'





        ];

        foreach ($masterMusicData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Music',
                            'active' => 1,
                        ]);
        }



$masterOutdoorHobbiesData = [
       'Amusement Parks',
        'Antique Shows',
        'Art Galleries',
        'Bar Hopping',
        'Beachcombing',
        'Bird Watching',
        'Clubbing',
        'Coffee Shops' ,
        'Fine Dining',
        'Fishing',
        'Flea Markets',
        'Gambling',
        'Garage Sales',
        'Movies',
        'Museums',
        'Musical Theater',
        'Opera',
        'Raves',
        'Renaissance Fairs',
        'Shopping',
        'Travel',
        'Volunteerism'

        ];

        foreach ($masterOutdoorHobbiesData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Outdoor Hobbies',
                            'active' => 1,
                        ]);
        }


$masterPreferredCommunityCategoriesData = [
     'Celebrities & Public Figures',
    'Business Pages',
    'Social Services & NGOs',
    'Business & Profession',
    'Science & Technology',
    'Politics & Current-Affairs',
    'Smart-Living & Health-Care',
    'Education',
    'Travel, Tourism & Hospitality',
    'Media & Entertainment',
    'Sports',
    'Faith & Philosophy',
    'Ethics & Human-Rights',
    'Arts, Literature & Creativity',
    'Life-Style-Men',
    'Life-Style-Women',
    'Parenting & Childcare',
    'Old-Age Planning & Care',
    'Pets',
    'Save the Globe Environmental Issues',
    'Animal-Welfare & Wild-Life',
    'Do it Yourself',
    'Back to Basics',
    'Regional & Local',
        ];

        foreach ($masterPreferredCommunityCategoriesData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Preferred Community Categories ',
                            'active' => 1,
                        ]);
        }




$masterSpiritualInterestsData = [
    ' Agnosticism',
    'Atheism',
    'Buddhism',
    'Catholicism',
    'Christianity',
    'Druidism',
    'Feng Shui',
    'Hinduism',
    'Islam',
    'Judaism',
    'Kabbalah',
    'Mormonism',
    'Neo-Paganism',
    'Reiki',
    'Scientology',
    'Wicca' 

        ];

        foreach ($masterSpiritualInterestsData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Spiritual Interests',
                            'active' => 1,
                        ]);
        }




$masterSportsData = [
    'Auto Racing',
    'Badminton',
    'Baseball',
    'Basketball',
    'BMX',
    'Body Building',
    'Boxing',
    'Bowling',
    'Cricket',
    'Darts',
    'Football',
    'Golf',
    'Horse Racing',
    'Ice Hockey',
    'Kick Boxing',
    'Paintball',
    'Skiing',
    'Sky Diving',
    'Snowboarding',
    'Soccer',
    'Street Hockey',
    'Swimming',
    'Tennis',
    'Volleyball',
    'Wrestling'


        ];

        foreach ($masterSportsData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Sports',
                            'active' => 1,
                        ]);
        }






        $masterProfessionSkillsData = [
                    'Accounting',
                    'Administrative/Managerial',
                    'Arts/Entertainment/Media',
                    'Aviation/Automotive',
                    'Biotechnology',
                    'Business Development/ Strategy - Planning',
                    'Clerical/Office-Work',
                    'Construction',
                    'Consultancy',
                    'Contract & Freelance',
                    'Customer Service',
                    'Education',
                    'Engineering',
                    'Executive',
                    'Facilities',
                    'Financial Services',
                    'Financial Markets',
                    'Food Industry',
                    'Franchise',
                    'Government',
                    'Grocery/Super Markets/Malls',
                    'Healthcare',
                    'Hospitality/Travels/Tourism',
                    'Human Resources',
                    'Import/Export',
                    'Information Technology',
                    'Insurance',
                    'Internships & College',
                    'Law Enforcement',
                    'Legal Services',
                    'Logistics/Transportation',
                    'Manufacturing/Production',
                    'Marketing',
                    'Non-Profit & NGO',
                    'Other',
                    'Real Estate',
                    'Retail/Wholesale Trading',
                    'Sales',
                    'Science',
                    'Student',
                    'Telecommunications',
                    'Training',
                    'Warehousing/ Supply Chain',
                    'Actor/Actoress'



        ];

        foreach ($masterProfessionSkillsData as $value) {
                 DB::table('skills')->insert([
                           'label' => $value,
                           'parent' => 'Profession',
                            'active' => 1,
                        ]);
        }


    }
}
