<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileFamily extends Moloquent
{
    use SoftDeletes;

    protected $collection = 'profile_families';
    protected $primaryKey = '_id';
    /**Note: family_name variable is free text input field 
     *  1. Contact to contact search into PSN record & add into family member group
     *  2. Free text :
     *       a.  Register in psn but not in contact
     *       b.  Unregistered on PSN
     * 
     */
    protected $fillable = [
        'profile_id', 'family_profile_id','family_name','relation_id','created_at','updated_at','active'
    ];

    protected $hidden = [];
    
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
