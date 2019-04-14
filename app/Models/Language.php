<?php

namespace App\Models;

use Moloquent\Eloquent\Model as Moloquent;
use Moloquent\Eloquent\SoftDeletes;

class Language extends Moloquent
{
   //use SoftDeletes;

    protected $collection = 'languages';
    protected $primaryKey = '_id';
    
    /// place_type( Home town , current location, other place lived)
    protected $fillable = [
         'language'
    ];
    
    protected $hidden = [];
    
    
    ////   (ProfileEducation::class
    
     
}
