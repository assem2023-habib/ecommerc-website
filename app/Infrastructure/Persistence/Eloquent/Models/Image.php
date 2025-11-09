<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path',
        'alt_text',
        'is_show'
    ];
    public function imageable()
    {
        return $this->morphTo();
    }
}
