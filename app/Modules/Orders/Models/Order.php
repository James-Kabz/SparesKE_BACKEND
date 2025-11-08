<?php

namespace App\Modules\Orders\Models;

use App\Models\User;
use App\Modules\Parts\Models\Part;
use App\Modules\Vendors\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vendor_id',
        'part_id',
        'status',
        'pickup_point',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
