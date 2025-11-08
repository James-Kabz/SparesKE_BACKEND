<?php

namespace App\Modules\Report\Models;

use App\Models\User;
use App\Modules\Parts\Models\Part;
use App\Modules\Vendors\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'vendor_id',
        'part_id',
        'reason',
        'status',
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
