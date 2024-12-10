<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualMaintenance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'state',
        'district',
        'taluka',
        'gram',
        'maintenance_year',
        'maintenance_amount',
        'remaining_amount',
        'payment_mode',
        'description',
        'current_population',
        'bill_status',
    ];
}
