<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'breed',
        'age_years',
        'age_months',
        'description',
        'profile_img',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'availablity', 'impressions',
    ];

    public function users()
    {
        return $this->belongsToMany(Pet::class);
    }
}
