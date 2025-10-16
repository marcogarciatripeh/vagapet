<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\CompanyProfile;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::active()->with('companyProfile');

        // Filtros
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('city')) {
            $query->byCity($request->city);
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        if ($request->filled('area')) {
            $query->byArea($request->area);
        }

        if ($request->filled('contract_type')) {
            $query->where('contract_type', $request->contract_type);
        }

        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->experience_level);
        }

        if ($request->filled('salary_min')) {
            $query->where('salary_min', '>=', $request->salary_min);
        }

        if ($request->filled('salary_max')) {
            $query->where('salary_max', '<=', $request->salary_max);
        }

        if ($request->filled('is_remote')) {
            $query->where('is_remote', true);
        }

        if ($request->filled('is_featured')) {
            $query->featured();
        }

        // Ordenação
        $sort = $request->get('sort', 'published_at');
        $direction = $request->get('direction', 'desc');

        switch ($sort) {
            case 'salary':
                $query->orderBy('salary_min', $direction);
                break;
            case 'company':
                $query->join('company_profiles', 'jobs.company_profile_id', '=', 'company_profiles.id')
                      ->orderBy('company_profiles.company_name', $direction);
                break;
            default:
                $query->orderBy($sort, $direction);
        }

        $jobs = $query->paginate(12);

        // Dados para filtros
        $cities = Job::active()->distinct()->pluck('city')->filter()->sort()->values();
        $states = Job::active()->distinct()->pluck('state')->filter()->sort()->values();
        $areas = Job::active()->distinct()->pluck('area')->filter()->sort()->values();

        return view('public.jobs.index', compact('jobs', 'cities', 'states', 'areas'));
    }

    public function show($slug)
    {
        $job = Job::active()
            ->where('slug', $slug)
            ->with(['companyProfile', 'applications'])
            ->firstOrFail();

        // Incrementar visualizações
        $job->incrementViews();

        // Vagas relacionadas (mesma empresa ou área)
        $related_jobs = Job::active()
            ->where('id', '!=', $job->id)
            ->where(function ($query) use ($job) {
                $query->where('company_profile_id', $job->company_profile_id)
                      ->orWhere('area', $job->area);
            })
            ->with('companyProfile')
            ->limit(4)
            ->get();

        return view('public.jobs.show', compact('job', 'related_jobs'));
    }
}
