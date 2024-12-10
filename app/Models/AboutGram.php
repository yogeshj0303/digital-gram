<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutGram extends Model
{
    use HasFactory;
    protected $fillable = [
        'state',
        'district',
        'taluka',
        'gram',
        'about_gram',
        'path',
    ];
}
