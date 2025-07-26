<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.professional.dashboard');
    }

    public function profile()
    {
        return view('dashboard.professional.profile');
    }

    public function applications()
    {
        return view('dashboard.professional.applications');
    }

    public function settings()
    {
        return view('dashboard.professional.settings');
    }

    public function publicPage()
    {
        return view('dashboard.professional.public-page');
    }

    public function favorites()
    {
        return view('dashboard.professional.favorites');
    }
}
