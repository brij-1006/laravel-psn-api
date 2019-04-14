<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileVisibility extends Moloquent
{
    use SoftDeletes;

    protected $collection = 'profile_addresses';
    protected $primaryKey = '_id';
    protected $fillable = [
         'profile_id', 'public', 'attribute_id','created_at','updated_at'
    ];

    protected $hidden = [
       // 'user_id'
        ];
}
