<?php

namespace App\Modules\Parts\Models;

use App\Models\Category;
use App\Modules\Orders\Models\Order;
use App\Modules\Report\Models\Report;
use App\Modules\Vendors\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'availability' => 'boolean',
    ];

    protected $with = ['category'];
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
