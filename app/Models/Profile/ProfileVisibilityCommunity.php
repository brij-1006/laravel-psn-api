<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileVisibilityCommunity extends Moloquent
{
    use SoftDeletes;

    protected $collection = 'profile_visibility_communities';
    protected $primaryKey = '_id';
    protected $fillable = [
       'profile_id', 'profile_visibility_id', 'community_category_id','created_at','updated_at'
    ];

    protected $hidden = [
       // 'user_id'
        ];
}
