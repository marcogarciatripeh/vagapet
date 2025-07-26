<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.company.dashboard');
    }

    public function profile()
    {
        return view('dashboard.company.profile');
    }

    public function manageJobs()
    {
        return view('dashboard.company.manage-jobs');
    }

    public function candidates()
    {
        return view('dashboard.company.candidates');
    }

    public function publicPage()
    {
        return view('dashboard.company.public-page');
    }

    public function favoriteProfessionals()
    {
        return view('dashboard.company.favorite-professionals');
    }

    public function createJob()
    {
        return view('dashboard.company.create-job');
    }
}
