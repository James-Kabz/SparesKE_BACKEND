<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'category_id',
        'name',
        'car_make',
        'car_model',
        'category',
        'price',
        'condition',
        'availability',
        'description',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'availability' => 'boolean',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
