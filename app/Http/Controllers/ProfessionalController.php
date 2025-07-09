<?php

namespace App\Http\Controllers;

class ProfessionalController extends Controller
{
    public function __construct()
    {

    }

    public function dashboard()
    {
        return view('professional.dashboard');
    }

    public function favorites()
    {
        return view('professional.favorites');
    }

    public function resume()
    {
        return view('professional.resume');
    }
}
