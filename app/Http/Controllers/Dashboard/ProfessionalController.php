<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Favorite;
use App\Models\ProfessionalProfile;

class ProfessionalController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Você precisa ter um perfil profissional para acessar esta página.');
        }

        // Estatísticas
        $stats = [
            'applications_count' => $profile->jobApplications()->count(),
            'pending_applications' => $profile->jobApplications()->pending()->count(),
            'approved_applications' => $profile->jobApplications()->approved()->count(),
            'favorites_count' => $profile->favorites()->count(),
        ];

        // Candidaturas recentes
        $recent_applications = $profile->jobApplications()
            ->with('job.companyProfile')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Vagas recomendadas (baseadas na área do profissional)
        $recommended_jobs = Job::active()
            ->whereIn('area', $profile->areas ?? [])
            ->whereNotIn('id', $profile->jobApplications()->pluck('job_id'))
            ->with('companyProfile')
            ->limit(6)
            ->get();

        return view('dashboard.professional.dashboard', compact('stats', 'recent_applications', 'recommended_jobs'));
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        return view('dashboard.professional.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'zip_code' => 'nullable|string|max:10',
            'bio' => 'nullable|string|max:1000',
            'areas' => 'nullable|array',
            'skills' => 'nullable|array',
            'education' => 'nullable|array',
            'experience' => 'nullable|array',
            'years_experience' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'resume' => 'nullable|file|mimes:pdf|max:5120',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'website' => 'nullable|url',
        ]);

        $data = $request->except(['photo', 'resume']);

        // Upload de foto
        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $data['photo'] = $request->file('photo')->store('profiles/photos', 'public');
        }

        // Upload de currículo
        if ($request->hasFile('resume')) {
            if ($profile->resume) {
                Storage::disk('public')->delete($profile->resume);
            }
            $data['resume'] = $request->file('resume')->store('profiles/resumes', 'public');
        }

        $profile->update($data);

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function applications(Request $request)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        $query = $profile->jobApplications()->with('job.companyProfile');

        // Filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->whereHas('job', function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%");
            });
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.professional.applications', compact('applications'));
    }

    public function applyToJob(Request $request, $jobId)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        $job = Job::active()->findOrFail($jobId);

        // Verificar se já se candidatou
        if ($profile->jobApplications()->where('job_id', $jobId)->exists()) {
            return back()->withErrors(['error' => 'Você já se candidatou para esta vaga.']);
        }

        $request->validate([
            'cover_letter' => 'nullable|string|max:1000',
            'resume_file' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = [
            'job_id' => $jobId,
            'professional_profile_id' => $profile->id,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ];

        // Upload de currículo específico para esta vaga
        if ($request->hasFile('resume_file')) {
            $data['resume_file'] = $request->file('resume_file')->store('applications/resumes', 'public');
        }

        JobApplication::create($data);

        // Incrementar contador de candidaturas
        $job->incrementApplications();
        $profile->incrementApplications();

        return back()->with('success', 'Candidatura enviada com sucesso!');
    }

    public function withdrawApplication($applicationId)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        $application = $profile->jobApplications()->findOrFail($applicationId);

        if ($application->status !== 'pending') {
            return back()->withErrors(['error' => 'Não é possível cancelar esta candidatura.']);
        }

        $application->update(['status' => 'withdrawn']);

        return back()->with('success', 'Candidatura cancelada com sucesso.');
    }

    public function favorites()
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        $favorites = $profile->favorites()
            ->with('favoritable')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('dashboard.professional.favorites', compact('favorites'));
    }

    public function toggleFavorite(Request $request)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        $request->validate([
            'favoritable_type' => 'required|in:App\Models\Job,App\Models\CompanyProfile',
            'favoritable_id' => 'required|integer',
        ]);

        $favorite = $profile->favorites()
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
        $profile = $user->professionalProfile;

        return view('dashboard.professional.public-page', compact('profile'));
    }

    public function settings()
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        return view('dashboard.professional.settings', compact('profile'));
    }
}
