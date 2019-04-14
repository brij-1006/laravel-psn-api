<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileFollower extends Moloquent
{
    use SoftDeletes;

    protected $collection = 'profile_followers';
    protected $primaryKey = '_id';
    ///  1 - follow 0- unfollow
    protected $fillable = [
       'profile_id', 'follower_id','follow_flag','created_at','updated_at'
    ];

    protected $hidden = [];
    
    
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
