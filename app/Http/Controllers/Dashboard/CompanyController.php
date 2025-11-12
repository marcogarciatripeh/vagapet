<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Favorite;
use App\Models\CompanyProfile;
use App\Models\ProfessionalProfile;

class CompanyController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Você precisa ter um perfil de empresa para acessar esta página.');
        }

        // Estatísticas
        $stats = [
            'jobs_count' => $profile->jobs()->count(),
            'active_jobs' => $profile->jobs()->active()->count(),
            'applications_received' => $profile->jobs()->withCount('applications')->get()->sum('applications_count'),
            'pending_applications' => JobApplication::whereHas('job', function ($q) use ($profile) {
                $q->where('company_profile_id', $profile->id);
            })->pending()->count(),
        ];

        // Vagas recentes
        $recent_jobs = $profile->jobs()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Candidaturas recentes
        $recent_applications = JobApplication::whereHas('job', function ($q) use ($profile) {
            $q->where('company_profile_id', $profile->id);
        })
        ->with(['job', 'professionalProfile'])
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

        return view('dashboard.company.dashboard', compact('stats', 'recent_jobs', 'recent_applications'));
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Você precisa ter um perfil de empresa para acessar esta página.');
        }

        return view('dashboard.company.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $request->validate([
            'company_name' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'zip_code' => 'nullable|string|max:10',
            'services' => 'nullable|array',
            'specialties' => 'nullable|array',
            'employees_count' => 'nullable|integer|min:1',
            'company_size' => 'nullable|in:micro,small,medium,large',
            'logo' => 'nullable|image|max:2048',
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'image|max:2048',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|url',
        ]);

        $data = $request->except(['logo', 'photos']);

        // Upload de logo
        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('companies/logos', 'public');
        }

        // Upload de fotos
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('companies/photos', 'public');
            }
            $data['photos'] = $photos;
        }

        $profile->update($data);

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function manageJobs(Request $request)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Você precisa ter um perfil de empresa para acessar esta página.');
        }

        $query = $profile->jobs();

        // Filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        $jobs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.company.manage-jobs', compact('jobs'));
    }

    public function createJob()
    {
        return view('dashboard.company.create-job');
    }

    public function createJobProcess(Request $request)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contract_type' => 'required|in:clt,pj,freelance,internship,temporary',
            'area' => 'nullable|string|max:100',
            'experience_level' => 'required|in:junior,pleno,senior,lead,any',
            'work_hours' => 'nullable|integer|min:1|max:60',
            'salary_type' => 'required|in:fixed,range,negotiable',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'work_location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'is_remote' => 'boolean',
            'is_hybrid' => 'boolean',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'deadline' => 'nullable|date|after:today',
            'currency' => 'nullable|string|max:3',
        ]);

        $data = $request->all();
        $data['company_profile_id'] = $profile->id;
        $data['is_remote'] = $request->boolean('is_remote');
        $data['is_hybrid'] = $request->boolean('is_hybrid');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_urgent'] = $request->boolean('is_urgent');
        $data['currency'] = $request->get('currency', 'BRL');
        $data['deadline'] = $request->deadline ?: null;

        if ($data['salary_type'] === 'negotiable') {
            $data['salary_min'] = null;
            $data['salary_max'] = null;
        } elseif ($data['salary_type'] === 'fixed') {
            $data['salary_max'] = null;
        } elseif ($data['salary_type'] === 'range' && $request->filled('salary_min') && $request->filled('salary_max')) {
            if ($data['salary_min'] > $data['salary_max']) {
                [$data['salary_min'], $data['salary_max']] = [$data['salary_max'], $data['salary_min']];
            }
        }

        $slugBase = Str::slug($request->title);
        $slug = $slugBase;
        $counter = 1;
        while (Job::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $counter++;
        }

        $data['slug'] = $slug;
        $data['status'] = 'draft';
        $data['published_at'] = null;

        Job::create($data);

        $profile->updateQuietly([
            'jobs_posted_count' => $profile->jobs()->count(),
        ]);

        return redirect()->route('company.manage-jobs')->with('success', 'Vaga criada com sucesso!');
    }

    public function editJob($id)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $job = $profile->jobs()->findOrFail($id);

        return view('dashboard.company.edit-job', compact('job'));
    }

    public function updateJob(Request $request, $id)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $job = $profile->jobs()->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contract_type' => 'required|in:clt,pj,freelance,internship,temporary',
            'area' => 'nullable|string|max:100',
            'experience_level' => 'required|in:junior,pleno,senior,lead,any',
            'work_hours' => 'nullable|integer|min:1|max:60',
            'salary_type' => 'required|in:fixed,range,negotiable',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'work_location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'is_remote' => 'boolean',
            'is_hybrid' => 'boolean',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'deadline' => 'nullable|date|after:today',
            'currency' => 'nullable|string|max:3',
            'status' => 'required|in:active,paused,closed,draft',
        ]);

        $data = $request->all();
        $data['is_remote'] = $request->boolean('is_remote');
        $data['is_hybrid'] = $request->boolean('is_hybrid');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_urgent'] = $request->boolean('is_urgent');
        $data['currency'] = $request->get('currency', $job->currency ?? 'BRL');
        $data['deadline'] = $request->deadline ?: null;

        if ($data['salary_type'] === 'negotiable') {
            $data['salary_min'] = null;
            $data['salary_max'] = null;
        } elseif ($data['salary_type'] === 'fixed') {
            $data['salary_max'] = null;
        } elseif ($data['salary_type'] === 'range' && $request->filled('salary_min') && $request->filled('salary_max')) {
            if ($data['salary_min'] > $data['salary_max']) {
                [$data['salary_min'], $data['salary_max']] = [$data['salary_max'], $data['salary_min']];
            }
        }

        $slugBase = Str::slug($request->title);
        $slug = $slugBase;
        $counter = 1;
        while (Job::where('slug', $slug)->where('id', '!=', $job->id)->exists()) {
            $slug = $slugBase . '-' . $counter++;
        }

        $data['slug'] = $slug;

        // Se mudou para ativo, definir data de publicação
        if ($request->status === 'active' && $job->status !== 'active') {
            $data['published_at'] = now();
        } elseif ($request->status !== 'active' && $job->status === 'active') {
            $data['published_at'] = $job->published_at;
        }

        $job->update($data);

        $profile->updateQuietly([
            'jobs_posted_count' => $profile->jobs()->count(),
        ]);

        return back()->with('success', 'Vaga atualizada com sucesso!');
    }

    public function deleteJob($id)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $job = $profile->jobs()->findOrFail($id);
        $job->delete();

        $profile->updateQuietly([
            'jobs_posted_count' => $profile->jobs()->count(),
        ]);

        return back()->with('success', 'Vaga excluída com sucesso!');
    }

    public function candidates(Request $request)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $query = JobApplication::whereHas('job', function ($q) use ($profile) {
            $q->where('company_profile_id', $profile->id);
        })->with(['job', 'professionalProfile']);

        // Filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('job_id')) {
            $query->where('job_id', $request->job_id);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(10);

        // Vagas para filtro
        $jobs = $profile->jobs()->active()->get();

        return view('dashboard.company.candidates', compact('applications', 'jobs'));
    }

    public function approveApplication($applicationId)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $application = JobApplication::whereHas('job', function ($q) use ($profile) {
            $q->where('company_profile_id', $profile->id);
        })->findOrFail($applicationId);

        $application->respond('approved', 'Candidatura aprovada!');

        return back()->with('success', 'Candidatura aprovada com sucesso!');
    }

    public function rejectApplication(Request $request, $applicationId)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $application = JobApplication::whereHas('job', function ($q) use ($profile) {
            $q->where('company_profile_id', $profile->id);
        })->findOrFail($applicationId);

        $request->validate([
            'response_message' => 'nullable|string|max:500',
        ]);

        $application->respond('rejected', $request->response_message);

        return back()->with('success', 'Candidatura rejeitada.');
    }

    public function favoriteProfessionals()
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $favorites = $user->favorites()
            ->where('favoritable_type', ProfessionalProfile::class)
            ->with('favoritable')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('dashboard.company.favorite-professionals', compact('favorites'));
    }

    public function toggleFavorite(Request $request)
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        $request->validate([
            'favoritable_type' => 'required|in:App\Models\ProfessionalProfile',
            'favoritable_id' => 'required|integer',
        ]);

        abort_unless(class_exists($request->favoritable_type), 422, 'Tipo inválido.');

        $request->favoritable_type::findOrFail($request->favoritable_id);

        $favorite = $user->favorites()
            ->where('favoritable_type', $request->favoritable_type)
            ->where('favoritable_id', $request->favoritable_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $action = 'removed';
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'favoritable_type' => $request->favoritable_type,
                'favoritable_id' => $request->favoritable_id,
            ]);
            $action = 'added';
        }

        return response()->json(['action' => $action]);
    }

    public function publicPage()
    {
        $user = Auth::user();
        $profile = $user->companyProfile;

        return view('dashboard.company.public-page', compact('profile'));
    }
}
