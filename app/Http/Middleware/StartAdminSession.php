<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession;

class StartAdminSession extends StartSession
{
    /**
     * Get the name of the session cookie.
     *
     * @return string
     */
    protected function getCookieName()
    {
        return config('session.cookie') . '_admin';
    }
}

