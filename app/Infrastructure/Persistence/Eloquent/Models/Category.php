<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'is_show',
        'is_trend',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function images()
    {
        return  $this->morphMany(Image::class, 'imageable');
    }
}
