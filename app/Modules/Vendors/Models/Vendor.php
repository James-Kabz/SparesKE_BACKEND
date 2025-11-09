<?php

namespace App\Modules\Vendors\Models;

use App\Models\User;
use App\Modules\Orders\Models\Order;
use App\Modules\Parts\Models\Part;
use App\Modules\PickupPoint\Models\PickupPoint;
use App\Modules\Review\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';

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

    protected $with = ['user'];

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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
