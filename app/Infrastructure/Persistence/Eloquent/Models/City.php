<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'city_name',
        'country_id',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'city_id');
    }
}
