<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;

class ProfileHistory extends Moloquent
{
    use SoftDeletes;

    protected $collection = 'profile_histories';
    protected $primaryKey = '_id';

    protected $fillable = [
        'name', 'price'
    ];

    protected $hidden = [];
    
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
