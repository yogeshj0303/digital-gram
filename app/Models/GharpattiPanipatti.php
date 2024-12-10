<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GharpattiPanipatti extends Model
{
    use HasFactory;
    protected $fillable = [
        'state',
        'district',
        'taluka',
        'gram',
        'username',
        'type',
        'amount_type',
        'paid_type',
        'paid_amount',
        'paid_date',
        'remaining_amount',
        'send_bill',
    ];
}
