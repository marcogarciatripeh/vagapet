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

    public function favoriteProfessionals()
    {
        return view('company.professionals.favorites');
    }

    public function searchCompanies()
    {
        return view('company.search');
    }

    public function companyJobs($id)
    {
        return view('company.jobs', compact('id'));
    }

    public function plans()
    {
        return view('company.plans');
    }
}
