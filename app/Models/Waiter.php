<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Waiter extends Authenticatable
{
    use Notifiable;

    protected $table = 'waiters';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = ['password'];

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }
}

