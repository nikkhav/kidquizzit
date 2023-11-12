<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        \Log::info('Redirecting...');
        // Check if the request is for the API
        if ($request->is('api/*')) {
            return null; // Do not redirect for API requests
        }
        if (!$request->expectsJson()) {
            return route('/');
        }
    }
}
