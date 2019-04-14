<?php

namespace App;

use Moloquent\Eloquent\Model as Moloquent;

class Product extends Moloquent
{

    protected $collection = 'products';
    protected $primaryKey = '_id';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
    ];
}
