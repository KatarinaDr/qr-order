<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rtable extends Model
{
    protected $fillable = [
        'number',
        'web_page',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
