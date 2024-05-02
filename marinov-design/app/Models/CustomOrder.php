<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'message',
        'images',
        'send_link',
    ];

    protected $casts = [
        'images' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
