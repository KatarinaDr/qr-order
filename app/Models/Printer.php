<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'printer_name',
        'mac_address',
        'interface',
    ];

    public function article()
    {
        return $this->belongsToMany(Article::class, 'article_printer')->withTimestamps();
    }
}
