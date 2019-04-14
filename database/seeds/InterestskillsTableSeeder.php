<?php

use Illuminate\Database\Seeder;

class InterestskillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $masterData = [
        'Adventures & Aerobics',
        'Hobby with Skill',
        'Intellectual Interests' ,
        'Music',
        'Outdoor Hobbies',
        'Preferred Community Categories',
        'Spiritual Interests',
        'Sports',
        'Profession Skills'

        ];

        foreach ($masterData as $value) {
                 DB::table('interest_skills')->insert([
                           'label' => $value,
                            'active' => 1,
                        ]);
        }
    }
}
