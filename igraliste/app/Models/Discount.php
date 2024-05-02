<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function discountCategories()
    {
        return $this->belongsToMany(DiscountCategory::class, 'category_discount', 'discount_id', 'discount_category_id');
    }
    

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
