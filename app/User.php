<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Moloquent\Eloquent\SoftDeletes;
use Moloquent\Eloquent\Model as Moloquent;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Laravel\Passport\HasApiTokens;
use App\Models\Profile\Profile;

class User extends Moloquent implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasApiTokens, Notifiable, SoftDeletes;

    protected $collection = 'users';
    protected $primaryKey = '_id';

    protected $fillable = [
        'mobile', 'email', 'password','remember','password_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    
    
}
