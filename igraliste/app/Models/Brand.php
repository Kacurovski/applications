<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'brand_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'brand_tag');
    }

    public function images()
    {
        return $this->hasMany(BrandImage::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
