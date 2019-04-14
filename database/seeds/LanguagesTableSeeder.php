<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $masterData = [
        'Hindi',
        'English',
        'Sanskrit' ,
        'Bengali',
        'Telugu',
        'Marathi',
        'Tamil',
        'Urdu',
        'Kannada',
        'Gujarati',
         'Odia',
        'Malayalam',
        'Punjabi',
        'Spanish',
        'Arabic',
        'Russian',
        'Japanese',
        'German',
        'Vietnamese',
        'Korean',
        'French',
        'Turkish',
        'Italian',
        'Thai',
        'Bhojpuri',
        'Somali',
        'Malay'

        ];

        foreach ($masterData as $value) {
                 DB::table('languages')->insert([
                           'label' => $value,
                            'active' => 1,
                        ]);
        }
    }
}
