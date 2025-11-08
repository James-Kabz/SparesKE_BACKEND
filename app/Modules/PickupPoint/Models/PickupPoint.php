<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'location',
        'contact_number',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
