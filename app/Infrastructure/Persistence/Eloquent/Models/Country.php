<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country_name',
        'country_code',
    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }
}
