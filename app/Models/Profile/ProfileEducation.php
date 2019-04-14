<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileEducation extends Moloquent
{
    use SoftDeletes;

    protected $collection = 'profile_educations';
    protected $primaryKey = '_id';

    protected $fillable = [
        ///  score_type  -  1 for  GPI  , 2  for  Percentage
          'profile_id', 'institute_id', 'start_at', 'end_at', 'skilled_earned','program_id','stream','program_description','achievements','score_type','grade','score','specializations','created_at', 'update_at'
    
    ];

    protected $hidden = [];
    
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
