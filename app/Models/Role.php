<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use SoftDeletes;

    protected $collection = 'roles';
    protected $primaryKey = '_id';

    protected $fillable = ['title','role','created_at','updated_at' ,'updated_by' ,'active'];

    protected $hidden = [];
}
