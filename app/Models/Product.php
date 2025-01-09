<?php

namespace App\Models;

use App\Traits\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, FileHelper;

    protected $fillable = [
        'name',
        'slug',
        'qty',
        'price',
        'thumbnail',
        'description',
    ];

    public function productGallery(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }
}
