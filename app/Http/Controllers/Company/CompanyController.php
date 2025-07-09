<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function __construct()
    {

    }

    public function dashboard()
    {
        return view('company.dashboard');
    }

    public function searchProfessionals()
    {
        return view('company.professionals.search');
    }

    public function plans()
    {
        return view('company.plans');
    }
}
