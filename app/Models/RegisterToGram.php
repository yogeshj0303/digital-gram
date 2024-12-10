<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterToGram extends Model
{
    use HasFactory;
    protected $fillable = [
        'state',
        'district',
        'taluka',
        'gram',
        'category',
    ];

    public function files()
{
    return $this->hasMany(File::class);  // Assuming you have a File model
}
}
