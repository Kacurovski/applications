<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }

    public function maintenances()
    {
        return $this->belongsToMany(Maintenance::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }

    public function favoritedByUsers()
    {
        return $this->hasMany(ProductFavorite::class);
    }

    public function inCartsOfUsers()
    {
        return $this->belongsToMany(User::class, 'user_cart_products');
    }
}
