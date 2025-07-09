<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function index()
    {
        // TODO: No futuro, detectar o tipo real do usuário logado
        $userType = 'professional'; // ou 'company'

        return view('change-password.index', compact('userType'));
    }
}
