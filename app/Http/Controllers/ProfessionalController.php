<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfessionalProfile;

class ProfessionalController extends Controller
{
    public function index(Request $request)
    {
        $query = ProfessionalProfile::active()->with('user');

        // Filtros
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('city')) {
            $query->byCity($request->city);
        }

        if ($request->filled('state')) {
            $query->byState($request->state);
        }

        if ($request->filled('area')) {
            $query->byArea($request->area);
        }

        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->experience_level);
        }

        if ($request->filled('experience_min')) {
            $query->where('years_experience', '>=', $request->experience_min);
        }

        if ($request->filled('experience_max')) {
            $query->where('years_experience', '<=', $request->experience_max);
        }

        // Ordenação
        $sort = $request->get('sort', 'views_count');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        // Paginação
        $perPage = $request->get('per_page', 12);
        $perPage = in_array($perPage, [10, 12, 20, 30, 40, 50, 60]) ? (int) $perPage : 12;
        $professionals = $query->paginate($perPage)->withQueryString();

        // Buscar TODOS os profissionais para o mapa (com coordenadas)
        $mapProfessionals = ProfessionalProfile::active()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', 0)
            ->where('longitude', '!=', 0)
            ->get()
            ->map(function ($professional) {
                $photoUrl = $professional->photo 
                    ? asset('storage/' . $professional->photo) 
                    : asset('images/resource/default-avatar.png');
                
                $areas = is_array($professional->areas) 
                    ? implode(', ', array_slice($professional->areas, 0, 2))
                    : ($professional->areas ?? 'Profissional');
                
                return [
                    'id' => $professional->id,
                    'title' => $professional->first_name . ' ' . $professional->last_name,
                    'type' => $areas,
                    'address' => ($professional->city ?? '') . ', ' . ($professional->state ?? ''),
                    'latitude' => (float) $professional->latitude,
                    'longitude' => (float) $professional->longitude,
                    'photo' => $photoUrl,
                    'url' => route('professionals.show', $professional->id),
                ];
            });

        // Verificar quais profissionais estão favoritados (para empresas logadas)
        $favoritedIds = collect();
        if (Auth::check()) {
            $user = Auth::user();
            if ($user && $user->companyProfile) {
                $favoritedIds = \App\Models\Favorite::where('user_id', $user->id)
                    ->where('favoritable_type', ProfessionalProfile::class)
                    ->whereIn('favoritable_id', $professionals->pluck('id'))
                    ->pluck('favoritable_id');
            }
        }

        // Dados para filtros
        $cities = ProfessionalProfile::active()->distinct()->pluck('city')->filter()->sort()->values();
        $states = ProfessionalProfile::active()->distinct()->pluck('state')->filter()->sort()->values();
        $areas = ProfessionalProfile::active()->distinct()->pluck('areas')->filter()->flatten()->unique()->sort()->values();
        $experienceLevels = [
            'estagio' => 'Estágio',
            'junior' => 'Júnior',
            'pleno' => 'Pleno',
            'senior' => 'Sênior',
        ];

        return view('public.professionals.index', [
            'professionals' => $professionals,
            'mapProfessionals' => $mapProfessionals,
            'favoritedIds' => $favoritedIds,
            'cities' => $cities,
            'states' => $states,
            'areas' => $areas,
            'experienceLevels' => $experienceLevels,
        ]);
    }

    public function show($id)
    {
        $professional = ProfessionalProfile::active()
            ->with(['user', 'jobApplications.job'])
            ->findOrFail($id);

        // Incrementar visualizações
        $professional->incrementViews();

        // Verificar se o profissional está favoritado (para empresas)
        $isFavorited = false;
        if (Auth::check()) {
            $user = Auth::user();
            if ($user && $user->companyProfile) {
                $isFavorited = \App\Models\Favorite::where('user_id', $user->id)
                    ->where('favoritable_type', ProfessionalProfile::class)
                    ->where('favoritable_id', $professional->id)
                    ->exists();
            }
        }

        return view('public.professionals.show', compact('professional', 'isFavorited'));
    }
}
