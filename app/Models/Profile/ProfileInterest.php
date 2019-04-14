<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileInterest extends Moloquent {

    use SoftDeletes;

    protected $collection = 'profile_interests';
    protected $primaryKey = '_id';
    protected $fillable = [
        'profile_id', 'interest_id'
    ];
    protected $hidden = [];

    public function profile() {
        return $this->belongsTo(Profile::class);
    }

}
