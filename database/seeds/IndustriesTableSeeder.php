<?php

use Illuminate\Database\Seeder;

class IndustriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masterData = [
        'Accounting',
        'Advertising & Marketing',
        'Aerospace' ,
        'Agribusiness',
        'Agriculture',
        'Automotive',
        'Auto Components',
        'Aviation',
        'Banking',
        'Biotechnology',
        'Broadcasting',
        'Building Materials',
        'Chemical'  ,
        'Computer Hardwares',
        'Construction',
        'Consumer Products',
        'Consultancy & Advisory',
        'eCommerce',
        'Defense & Arms',
        'Education and Training',
        'Energy & power',
        'Engineering (Non-IT)',
        'Entertainment',
        'Export & Import',
        'Film',
        'Financial Services',
        'Food Industry',
        'Gems and Jewellery',
        'General Merchandise',
        'Government Jobs',
        'Healthcare',
        'Hospitality' ,
        'Infrastructure',
        'Internet',
        'Insurance',
        'Information Technology',
        'Mass media' ,
        'Manufacturing',
        'Media and Entertainment',
        'Music' ,
        'News media',
        'OfficeAdmin-FrontDesk',
        'OfficeAdmin-BackDesk' ,
        'OfficeAdmin-Supporting',
        'Oil and Gas',
        'Pharmaceuticals',
        'Publishing',
        'Pulp and paper',
        'Railways',
        'Real Estate',
        'Research and Development',
        'Retail',
        'Sports',
        'Sales & Marketing',
        'Steel industry',
        'Shipbuilding',
        'Surveillance & Security',
        'Telecommunications',
        'Transport',
        'Timber industry',
        'Tobacco industry',
        'Water'

        ];

        foreach ($masterData as $value) {
                 DB::table('industries')->insert([
                           'label' => $value,
                            'active' => 1,
                        ]);
        }
    
    }
}
