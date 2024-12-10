<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'register_to_gram_id'];  // Make sure path and foreign key are fillable

    public function registerToGram()
    {
        return $this->belongsTo(RegisterToGram::class);
    }
}
