<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Models\Job;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = CompanyProfile::active()->with('user');

        // Filtros
        if ($request->filled('search')) {
            $query->where('company_name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
        }

        if ($request->filled('city')) {
            $query->byCity($request->city);
        }

        if ($request->filled('state')) {
            $query->byState($request->state);
        }

        if ($request->filled('company_size')) {
            $query->where('company_size', $request->company_size);
        }

        if ($request->filled('services')) {
            $query->whereJsonContains('services', $request->services);
        }

        // Ordenação
        $sort = $request->get('sort', 'views_count');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $companies = $query->paginate(12);

        // Dados para filtros
        $cities = CompanyProfile::active()->distinct()->pluck('city')->filter()->sort()->values();
        $states = CompanyProfile::active()->distinct()->pluck('state')->filter()->sort()->values();
        $sizes = ['micro', 'small', 'medium', 'large'];

        return view('public.companies.index', compact('companies', 'cities', 'states', 'sizes'));
    }

    public function show($id)
    {
        $company = CompanyProfile::active()
            ->with(['user', 'jobs' => function ($query) {
                $query->active()->orderBy('published_at', 'desc');
            }])
            ->findOrFail($id);

        // Incrementar visualizações
        $company->incrementViews();

        // Vagas ativas da empresa
        $active_jobs = $company->jobs()->active()->limit(6)->get();

        return view('public.companies.show', compact('company', 'active_jobs'));
    }
}
