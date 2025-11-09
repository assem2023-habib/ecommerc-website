<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use App\Infrastructure\Persistence\Eloquent\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'price',
        'stock',
        'discount',
        'is_show',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function images()
    {
        return  $this->morphMany(Image::class,  'imageable');
    }
}
