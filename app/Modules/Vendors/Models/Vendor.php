<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_name',
        'description',
        'location',
        'phone',
        'verified',
        'rating',
        'socials',
    ];

    protected $casts = [
        'socials' => 'array',
        'verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function pickupPoints()
    {
        return $this->hasMany(PickupPoint::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
