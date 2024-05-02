<?php

namespace App\Models;

use App\Models\Discussion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}
