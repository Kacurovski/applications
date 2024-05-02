<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ImageKit\ImageKit;

class CustomOrderGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image',
    ];

    protected $imageKit;

    public function __construct(ImageKit $imageKit)
    {
        $this->imageKit = $imageKit;
    }
}
