<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'jp_name',
        'en_name',
        'code',
        'image',
    ];

    protected $hidden = [];

    protected $casts = [];
}
