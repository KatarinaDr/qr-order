<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'image_url',
        'tags',
        'is_active',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];

    public function printer()
    {
        return $this->belongsToMany(Printer::class, 'article_printer')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'article_category')->withTimestamps();
    }

}
