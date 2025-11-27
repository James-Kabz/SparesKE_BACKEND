<?php

namespace App\Modules\Parts\Models;

use App\Models\Category;
use App\Modules\Orders\Models\Order;
use App\Modules\Report\Models\Report;
use App\Modules\Vendors\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Part extends Model
{
    use HasFactory;

    protected $table = 'parts';
    protected $fillable = [
        'vendor_id',
        'category_id',
        'name',
        'car_make',
        'car_model',
        'price',
        'condition',
        'availability',
        'description',
        'images', // ADD THIS - it was missing!
    ];

    protected $casts = [
        'images' => 'array',
    ];

    // REMOVE this line - it's causing the accessor to override the actual data
    // protected $appends = ['images'];

    protected $with = ['category', 'orders' , 'reports'];

    // REPLACE the accessor with this one that properly handles the images array
    public function getImagesAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        $images = json_decode($value, true) ?? [];

        // Convert relative paths to full URLs
        return array_map(function ($path) {
            return url(Storage::url($path));
        }, $images);
    }

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
