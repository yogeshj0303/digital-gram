<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gram extends Model
{
    use HasFactory;
    protected $fillable = ['gram_name', 'state', 'district', 'taluka', 'village', 'address', 'pin_code'];

}
