<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileAddress extends Moloquent
{
     use SoftDeletes;

    protected $collection = 'profile_addresses';
    protected $primaryKey = '_id';
   /**
    * address_flag :-  
    * 1 for current address ,
    * 2- Work address , 
    * 3- Home Address, 
    * 0-  other address
    */
    protected $fillable = [
        'profile_id', 'address', 'phone', 'city', 'state','country','address_flag','email','chat_id','created_at', 'updated_at'
    ];

    protected $hidden = [
       // 'user_id'
        ];
   // protected $guarded = ['profile_id' ]; //  This field value is not updated into database 
    
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
