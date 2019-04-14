<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;



class ProfilePlace extends Moloquent
{
    use SoftDeletes;

    protected $collection = 'profile_places';
    protected $primaryKey = '_id';
    
    /// place_type( Home town , current location, other place lived)
    protected $fillable = [
        'profile_id', 'location_type','location','active'
    ];
    protected $hidden = [];
    
    
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
