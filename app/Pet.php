<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name',
        'type',
        'breed',
        'age_years',
        'age_months',
        'description',
    ];

    protected $hidden = [
        'availablity',
    ];
}
