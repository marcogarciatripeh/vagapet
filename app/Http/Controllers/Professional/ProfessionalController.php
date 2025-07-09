<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;

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
