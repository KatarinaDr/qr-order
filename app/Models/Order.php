<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Facades\Artisan;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'table',
        'total'
    ];

    protected $casts = [
    
    ];

        // Boot method to hook into the created event
        protected static function boot()
        {
            
            parent::boot();
            
            /*
            // Trigger Artisan command when a new order is created
            static::created(function ($order) {
                //$orderJson = json_encode([$order->toArray()], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                $orderJson = '[{"title": "Article 1", "quantity": 2, "price": 15.00}, {"title": "Article 2", "quantity": 1, "price": 25.00}, {"title": "Article 3", "quantity": 3, "price": 10.00}]';
    
                // Call the Artisan command and pass the order as an argument
                Artisan::call('order:print', [
                    'order' => $orderJson
                ]);
            }); */
        }
    

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
