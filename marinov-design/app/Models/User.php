<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function shippingDetails()
    {
        return $this->hasMany(ShippingDetail::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function favoriteProducts()
    {
        return $this->hasMany(ProductFavorite::class);
    }

    public function cartProducts()
    {
        return $this->belongsToMany(Product::class, 'user_cart_products');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function customOrders()
    {
        return $this->hasMany(CustomOrder::class);
    }

    public function giftCards()
    {
        return $this->hasMany(GiftCards::class);
    }
}
