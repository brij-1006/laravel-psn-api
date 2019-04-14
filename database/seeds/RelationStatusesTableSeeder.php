<?php

use Illuminate\Database\Seeder;

class RelationStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masterData = [
        'Single',
        'Engaged',
        'Married',
        'Widowed',
       ' In a relationship',
        'I don’t want to say it'

        ];

        foreach ($masterData as $value) {
                 DB::table('relationship_statuses')->insert([
                           'relation_status' => $value,
                        ]);
        }
    }
}
