<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'article_id',
        'sifra',
        'title',
        'table',
        'price',
        'printer',
        'total',
        'quantity',
        'extras',
        'note',
    ];

    protected $casts = [

    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
