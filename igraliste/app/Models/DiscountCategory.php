<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'discount_categories'; 

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'category_discount', 'discount_category_id', 'discount_id');
    }
}
