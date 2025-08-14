<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // middleware bawaan...
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}