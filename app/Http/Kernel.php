<?php

namespace App\Http;

class Kernel
{
    protected $routeMiddleware = [
        'check.license' => \App\Http\Middleware\CheckUserLicense::class,
    ];
}
