<?php
namespace App\Models;
namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class ProfileLanguage extends Moloquent
{
    use SoftDeletes;

    protected $collection = 'profile_languages';
    protected $primaryKey = '_id';
    protected $fillable = [
        'profile_id', 'language_id','create_at','update_at'
    ];
    protected $hidden = [];
    
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
    
    
    
    //  $roles = App\User::find(1)->roles()->orderBy('name')->get();
    
//    public function Languages()
//    {
//        //return $this->belongsToMany(ProfileLanguage::class);
//    }
    
    /**
     * Get the post that owns the comment.
     */
    public function Language()
    {
        return $this->belongsTo(Language::class,'language_id','profile_id');
    }
    
    public function Languages()
    {
        return $this->belongsToMany(ProfileLanguage::class,'profile_languages');
    }

}
