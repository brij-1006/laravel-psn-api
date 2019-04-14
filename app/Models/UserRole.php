<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model {
    
    use SoftDeletes;

    protected $collection = 'user_roles';
    protected $primaryKey = '_id';
    protected $fillable = ['userObjectId', 'roleObjectId'];
    protected $hidden = [];

}
