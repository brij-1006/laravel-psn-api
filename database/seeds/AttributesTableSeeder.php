<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $masterData = [
             'profile' =>[
                           'mobile','email','first_name' , 'last_name','short_name',
                           'gender', 'location','dob','nationality','tag_line','about',
                           'expertise_on','work_summary','profession_id','phone', 'website','avatar'
                           ],
        'address' =>['address','phone','email' , 'city','country'],
        'family' =>['family_profile_name','family_profile_id','relation_id'],
        'academic' =>['institute_id','institute_name','start_at','end_at','program_id','stream','skilled_earned',
                      'program_description','achievements','grade','score','specializations'
                      ],

        'academic' =>['institute_id','institute_name','start_at','end_at','program_id','stream','skilled_earned',
                      'program_description','achievements','grade','score','specializations'
                      ],

         'interest' =>['interest_id','language_id'],

        ];

foreach($masterData as $key => $value){
           foreach ($value as $val) {
                 DB::table('attributes')->insert([
                           'attribute_type' => $key,
                           'label' => $val,
                           'active' => 1,
                        ]);
        }
}


        
    }
}
