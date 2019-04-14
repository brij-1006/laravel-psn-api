<?php

namespace App\Models\Profile;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;
// For Avatar
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
//  End Here 

use App\Models\Profile\ProfileAddress;
use App\Models\Profile\ProfileEducation;
use App\Models\Profile\ProfileFamily;
use App\Models\Profile\ProfileFollower;
use App\Models\Profile\ProfileHistory;
use App\Models\Profile\ProfileInterest;
use App\Models\Profile\ProfileLanguage;
use App\Models\Language;
use App\Models\Profile\ProfileLoginHistory;
use App\Models\Profile\ProfilePlace;

class Profile extends Moloquent implements StaplerableInterface {
/**
 * EloquentTrait   for Avatar
 */
    
    //  use EloquentTrait;
    use SoftDeletes,EloquentTrait;

    protected $collection = 'profiles';
    protected $primaryKey = '_id';
    
    
    /**
     * expertise_on  is array()
     * 
     * 
     * **/
    
   protected $fillable = [
        'first_name',
        'last_name',
        'short_name',
        'profile_type',
        'premium_flag',
        'relation_status_id',
        'user_id',
        'gender',
        'industry_id',
        'life_event',
        'location',
        'dob',
        'nationality',
        'country_ext',
        'tag_line',
        'about',
        'expertise_on',
        'work_summary',
        'profession_id',
        'avatar',
        'phone',
        'website',
        'app_id',
        'app_version',
       'active'
    ];
   
   //  user_id field value is not return into response  then put into hidden array
    protected $hidden = [];   
    protected $guarded = ['user_id' ]; //  This field value is not updated into database 



   public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function profileAddress()
    {
        return $this->hasOne(ProfileAddress::class);
    }
    /**
     * Get the educatin record associated with the profile.
     */
    public function profileEducation()
    {
        return $this->hasOne(ProfileEducation::class);
       // return $this->hasOne(ProfileEducation::class,'profile_id');
    //   return $this->hasMany(ProfileEducation::class);
       // //  hasMany
       /// return $this->hasOne('App\Phone', 'foreign_key');
    }
    
     /**
     * Get all of the languages for the profile.
     */
//    public function languages()
//    {
//        return $this->hasManyThrough(ProfileLanguage::class,Language::class, 'profile_id', 'language_id', 'id');
//    }
    
    
    
    public function getAllProfileLanguages()
    {
        return $this->hasManyThrough(ProfileLanguage::class, Language::class);
        //return $this->hasManyThrough(ProfileLanguage::class, Language::class,'profile_id', 'language_id');
    }
     
    
    public function profileFamily()
    {
        return $this->hasOne(ProfileFamily::class);
    }
    
    public function profileHistory()
    {
        return $this->hasOne(ProfileHistory::class);
    }
    public function profileInterest()
    {
        return $this->hasOne(ProfileInterest::class);
    }
    public function profileFollower()
    {
        return $this->hasOne(ProfileFollower::class);
    }
    public function profileLanguage()
    {
        return $this->hasOne(ProfileLanguage::class);
    }
    public function profileLanguages()
    {
       // return $this->hasOne(ProfileLanguage::class);
        return $this->hasManyThrough(ProfileLanguage::class, Language::class);
    }
    public function profileLoginHistory()
    {
        return $this->hasOne(ProfileLoginHistory::class);
    }
    public function profilePlace()
    {
        return $this->hasOne(ProfilePlace::class);
    }
    
    
    public function getAllLanguages()
    {
        return $this->hasManyThrough(
            Language::class, ProfileLanguage::class,
            'profile_id', 'language_id', 'id'
        );
    }
    
    
     public function getAllLanguagespp()
    {
      //  return $this->belongsToMany(Language::class, ProfileLanguage::class,'language_id', 'id');
         //  return $this->belongsToMany(Language::class, ProfileLanguage::class,'language_id', 'id');
         
        ///   return $this->belongsToMany(ProfileLanguage::class, 'profile_languages');
         
         
         // return $this->hasManyThrough(ProfileLanguage::class, Profile::class, 'country_id', 'profile_id');
          
          
           return $this->hasManyThrough(ProfileLanguage::class, Language::class, 'profile_id', 'language_id');
    }

}
