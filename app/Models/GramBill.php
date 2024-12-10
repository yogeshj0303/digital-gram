<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GramBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'state', 'district', 'taluka', 'gram', 'population',
        'first_time_bill_amount', 'quatation_date', 'bill_date',
        'reference_number', 'maintenance_amount', 'description',
        'payment_mode', 'next_maintenance_date',
        'bill_status',
    ];
}
