<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = ['name', 'email', 'phone_number', 'password', 'image'];
    // Other model properties and methods...
}