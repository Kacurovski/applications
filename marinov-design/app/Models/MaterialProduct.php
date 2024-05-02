<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialProduct extends Model
{
    use HasFactory;

    protected $table = 'material_product';

    // Assuming you have a 'material' relationship in your MaterialProduct model
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    // Assuming you have a 'product' relationship in your MaterialProduct model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
