<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Las URI que deben ser excluidas de la verificación CSRF.
     *
     * @var array
     */
    protected $except = [
        // Aquí agrega las rutas que deseas excluir de la verificación CSRF
        'api/tipo_documento',
        'api/tipo_documento/*',
        'api/*',
        '/*'
    ];
}