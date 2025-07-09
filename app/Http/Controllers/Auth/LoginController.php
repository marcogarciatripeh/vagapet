<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {

    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout()
    {
        return redirect()->route('home');
    }
}
