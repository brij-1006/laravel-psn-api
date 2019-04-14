<?php

use Illuminate\Database\Seeder;

class RelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $relation = ['Aunt',
        'Brother',
        'Brother-in-law',
        'Cousin',
        'Daughter',
        'Daughter-in-law',
        'Father',
        'Father-in-law',
        'Granddaughter',
        'Grandfather',
        'Grandmother',
        'Grandson',
        'Mother',
        'Mother-in-law',
        'Nephew',
        'Niece',
        'Sister',
        'Sister-in-law',
        'Son',
        'Son-in-law',
        'Spouse',
        'Stepbrother',
        'Stepdaughter',
        'Stepfather',
        'Stepmother',
        'Stepsister',
        'Stepson',
        'Uncle',
        'Other'
        ];

        foreach ($relation as $value) {
                 DB::table('relations')->insert([
            'relation' => $value,
                        ]);
        }
    }
}
