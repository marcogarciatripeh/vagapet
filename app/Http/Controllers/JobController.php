<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                $query->join('company_profiles', 'vagas.company_profile_id', '=', 'company_profiles.id')
                      ->orderBy('company_profiles.company_name', $direction);
                break;
            default:
                $query->orderBy($sort, $direction);
        }

        // Paginação
        $perPage = $request->get('per_page', 12);
        $perPage = in_array($perPage, [10, 12, 20, 30, 40, 50]) ? (int) $perPage : 12;
        $jobs = $query->paginate($perPage)->withQueryString();

        // Buscar TODAS as vagas para o mapa (com coordenadas da empresa)
        $mapJobs = Job::active()
            ->with('companyProfile')
            ->whereHas('companyProfile', function ($subQ) {
                $subQ->whereNotNull('latitude')
                     ->whereNotNull('longitude')
                     ->where('latitude', '!=', 0)
                     ->where('longitude', '!=', 0);
            })
            ->get()
            ->map(function ($job) {
                // Usar coordenadas da empresa
                $latitude = $job->companyProfile->latitude ?? null;
                $longitude = $job->companyProfile->longitude ?? null;
                
                if (!$latitude || !$longitude) {
                    return null;
                }
                
                $logoUrl = $job->companyProfile && $job->companyProfile->logo
                    ? asset($job->companyProfile->logo)
                    : asset('images/resource/default-company.png');
                
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'type' => ucfirst($job->contract_type ?? 'CLT'),
                    'address' => ($job->city ?? '') . ', ' . ($job->state ?? ''),
                    'latitude' => (float) $latitude,
                    'longitude' => (float) $longitude,
                    'photo' => $logoUrl,
                    'url' => route('jobs.show', $job->slug),
                ];
            })
            ->filter(); // Remove nulls

        // Verificar quais vagas estão favoritadas (para profissionais logados)
        $favoritedJobIds = collect();
        if (Auth::check()) {
            $user = Auth::user();
            if ($user && $user->professionalProfile) {
                $favoritedJobIds = \App\Models\Favorite::where('user_id', $user->id)
                    ->where('favoritable_type', Job::class)
                    ->whereIn('favoritable_id', $jobs->pluck('id'))
                    ->pluck('favoritable_id');
            }
        }

        // Dados para filtros
        $cities = Job::active()->distinct()->pluck('city')->filter()->sort()->values();
        $states = Job::active()->distinct()->pluck('state')->filter()->sort()->values();
        $areas = Job::active()->distinct()->pluck('area')->filter()->sort()->values();

        return view('public.jobs.index', compact('jobs', 'mapJobs', 'favoritedJobIds', 'cities', 'states', 'areas'));
    }

    public function show($slug)
    {
        $job = Job::active()
            ->where('slug', $slug)
            ->with(['companyProfile', 'applications'])
            ->firstOrFail();

        // Incrementar visualizações
        $job->incrementViews();

        // Verificar se o usuário já se candidatou
        $hasApplied = false;
        $isFavorited = false;
        
        if (Auth::check() && Auth::user()->professionalProfile) {
            $hasApplied = $job->applications()
                ->where('professional_profile_id', Auth::user()->professionalProfile->id)
                ->exists();
            
            // Verificar se a vaga está favoritada
            $isFavorited = Auth::user()->favorites()
                ->where('favoritable_type', Job::class)
                ->where('favoritable_id', $job->id)
                ->exists();
        }

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

        return view('public.jobs.show', compact('job', 'related_jobs', 'hasApplied', 'isFavorited'));
    }
}
