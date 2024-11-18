<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'https://hr.mantasoft.com.my/user/get-user',
        'https://hr.mantasoft.com.my/user/delete-user',
        'https://hr.mantasoft.com.my/user/save-attendance',
        'https://hr.mantasoft.com.my/user/history-attendance',
    ];
}
