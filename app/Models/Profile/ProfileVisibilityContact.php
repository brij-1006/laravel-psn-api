<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileVisibilityContact extends Moloquent
{
     protected $collection = 'profile_visibility_contacts';
     protected $primaryKey = '_id';
     protected $fillable = [
         'profile_id', 'profile_visibility_id', 'contacts_category_id','created_at','updated_at'
    ];

    protected $hidden = [
       // 'user_id'
        ];
}
