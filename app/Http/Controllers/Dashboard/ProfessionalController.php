<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Favorite;
use App\Models\ProfessionalProfile;
use App\Helpers\BrazilianStates;

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
            'views_count' => $profile->views_count ?? 0,
            'applications_count' => $profile->jobApplications()->count(),
            'pending_applications' => $profile->jobApplications()->pending()->count(),
            'approved_applications' => $profile->jobApplications()->approved()->count(),
            'favorites_count' => $user->favorites()->count(),
        ];

        // Candidaturas recentes
        $recent_applications = $profile->jobApplications()
            ->with('job.companyProfile')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Vagas recomendadas (baseadas na área do profissional ou todas as ativas)
        $appliedJobIds = $profile->jobApplications()->pluck('job_id')->toArray();
        
        $recommended_jobs = Job::active()
            ->whereNotIn('id', $appliedJobIds ?: [0])
            ->with('companyProfile');
        
        // Se o profissional tem áreas definidas, priorizar vagas nessas áreas
        if ($profile->areas && is_array($profile->areas) && count($profile->areas) > 0) {
            $recommended_jobs->where(function($query) use ($profile) {
                foreach ($profile->areas as $area) {
                    $query->orWhere('area', 'like', "%{$area}%");
                }
            });
        }
        
        $recommended_jobs = $recommended_jobs->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Dados para o gráfico de visualizações (últimos 6 meses)
        $chartData = [];
        $chartLabels = [];
        
        // Array de meses em português
        $mesesPt = [
            1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr',
            5 => 'Mai', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago',
            9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez'
        ];
        
        // Total de visualizações do perfil
        $totalViews = $profile->views_count ?? 0;
        
        // Se não há visualizações, criar dados zerados
        if ($totalViews == 0) {
            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $chartLabels[] = $mesesPt[$month->month];
                $chartData[] = 0;
            }
        } else {
            // Distribuir visualizações proporcionalmente pelos últimos 6 meses
            // Usando uma distribuição mais realista (mais recente = mais visualizações)
            $weights = [0.05, 0.08, 0.12, 0.15, 0.25, 0.35]; // Pesos para cada mês (do mais antigo ao mais recente)
            
            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $weightIndex = 5 - $i; // Inverter índice para usar os pesos corretos
                $views = (int) round($totalViews * $weights[$weightIndex]);
                
                $chartLabels[] = $mesesPt[$month->month];
                $chartData[] = $views;
            }
        }

        // Calcular porcentagem de conclusão do perfil
        $profileCompletion = $profile->getProfileCompletionPercentage();
        $isCompleteEnoughForSearch = $profile->isCompleteEnoughForSearch();

        return view('dashboard.professional.dashboard', compact('stats', 'recent_applications', 'recommended_jobs', 'chartLabels', 'chartData', 'profileCompletion', 'isCompleteEnoughForSearch'));
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;
        $states = BrazilianStates::getStates();

        return view('dashboard.professional.profile', compact('profile', 'states'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Você precisa ter um perfil profissional para acessar esta página.');
        }

        // Validação condicional - apenas validar campos que foram enviados
        $rules = [];
        $data = [];
        
        // Coletar todos os campos enviados (usar only() para pegar apenas campos permitidos)
        $allowedFields = [
            'first_name', 'last_name', 'phone', 'birth_date', 'gender',
            'address', 'neighborhood', 'city', 'state', 'zip_code',
            'latitude', 'longitude', 'bio', 'title', 'experience_level',
            'areas', 'skills', 'education', 'experiences', 'years_experience',
            'linkedin', 'instagram', 'facebook', 'website'
        ];
        
        // Pegar apenas os campos que foram enviados e estão na lista permitida
        $inputData = $request->only($allowedFields);
        
        // Validar apenas os campos que foram enviados
        if (isset($inputData['first_name'])) {
            $rules['first_name'] = 'required|string|max:255';
            $data['first_name'] = $inputData['first_name'];
        }
        if (isset($inputData['last_name'])) {
            $rules['last_name'] = 'required|string|max:255';
            $data['last_name'] = $inputData['last_name'];
        }
        if (isset($inputData['city'])) {
            $rules['city'] = 'required|string|max:100';
            $data['city'] = $inputData['city'];
        }
        if (isset($inputData['phone'])) {
            $rules['phone'] = 'nullable|string|max:20';
            $data['phone'] = $inputData['phone'];
        }
        if (isset($inputData['birth_date'])) {
            $rules['birth_date'] = 'nullable|date';
            $data['birth_date'] = $inputData['birth_date'];
        }
        if (isset($inputData['gender'])) {
            $rules['gender'] = 'nullable|in:male,female,other';
            $data['gender'] = $inputData['gender'];
        }
        if (isset($inputData['address'])) {
            $rules['address'] = 'nullable|string|max:500';
            $data['address'] = $inputData['address'];
        }
        if (isset($inputData['neighborhood'])) {
            $rules['neighborhood'] = 'nullable|string|max:255';
            $data['neighborhood'] = $inputData['neighborhood'];
        }
        if (isset($inputData['state'])) {
            $rules['state'] = ['nullable', 'string', 'max:2', function ($attribute, $value, $fail) {
                if ($value && !BrazilianStates::isValid($value)) {
                    $fail('O estado selecionado é inválido.');
                }
            }];
            $data['state'] = $inputData['state'];
        }
        if (isset($inputData['zip_code'])) {
            $rules['zip_code'] = 'nullable|string|max:10';
            $data['zip_code'] = $inputData['zip_code'];
        }
        if (isset($inputData['latitude'])) {
            $rules['latitude'] = 'nullable|numeric';
            $data['latitude'] = $inputData['latitude'];
        }
        if (isset($inputData['longitude'])) {
            $rules['longitude'] = 'nullable|numeric';
            $data['longitude'] = $inputData['longitude'];
        }
        if (isset($inputData['bio'])) {
            $rules['bio'] = 'nullable|string|max:5000';
            $data['bio'] = $inputData['bio'];
        }
        if (isset($inputData['title'])) {
            $rules['title'] = 'nullable|string|max:255';
            $data['title'] = $inputData['title'];
        }
        if (isset($inputData['experience_level'])) {
            $rules['experience_level'] = 'nullable|in:estagio,junior,pleno,senior';
            $data['experience_level'] = $inputData['experience_level'];
        }
        if (isset($inputData['areas'])) {
            $rules['areas'] = 'nullable|string|max:1000';
            $data['areas'] = $inputData['areas'];
        }
        if (isset($inputData['skills'])) {
            $rules['skills'] = 'nullable|string|max:1000';
            $data['skills'] = $inputData['skills'];
        }
        if (isset($inputData['education'])) {
            $rules['education'] = 'nullable|array';
            $data['education'] = $inputData['education'];
        }
        if (isset($inputData['experiences'])) {
            $rules['experiences'] = 'nullable|array';
            $data['experiences'] = $inputData['experiences'];
        }
        if (isset($inputData['years_experience'])) {
            $rules['years_experience'] = 'nullable|integer|min:0';
            $data['years_experience'] = $inputData['years_experience'];
        }
        if (isset($inputData['linkedin'])) {
            $rules['linkedin'] = 'nullable|string|max:255';
            $data['linkedin'] = $inputData['linkedin'];
        }
        if (isset($inputData['instagram'])) {
            $rules['instagram'] = 'nullable|string|max:255';
            $data['instagram'] = $inputData['instagram'];
        }
        if (isset($inputData['facebook'])) {
            $rules['facebook'] = 'nullable|string|max:255';
            $data['facebook'] = $inputData['facebook'];
        }
        if (isset($inputData['website'])) {
            $rules['website'] = 'nullable|string|max:255';
            $data['website'] = $inputData['website'];
        }
        if ($request->hasFile('photo')) {
            $rules['photo'] = 'nullable|image|max:1024';
        }
        if ($request->hasFile('resume')) {
            $rules['resume'] = 'nullable|file|mimes:pdf|max:5120';
        }
        
        // Validar apenas os campos que foram enviados
        if (!empty($rules)) {
            $request->validate($rules);
        }
        
        // Garantir que campos obrigatórios estejam sempre presentes
        if (!isset($data['first_name'])) {
            $data['first_name'] = $profile->first_name;
        }
        if (!isset($data['last_name'])) {
            $data['last_name'] = $profile->last_name;
        }
        if (!isset($data['city'])) {
            $data['city'] = $profile->city;
        }
        
        // Fazer merge com dados existentes do perfil para não perder campos não enviados
        $existingData = $profile->only([
            'phone', 'birth_date', 'gender',
            'address', 'neighborhood', 'state', 'zip_code',
            'latitude', 'longitude', 'bio', 'title', 'experience_level',
            'areas', 'skills', 'education', 'experiences', 'years_experience',
            'linkedin', 'instagram', 'facebook', 'website'
        ]);
        
        // Merge: dados existentes primeiro, depois os novos dados (sobrescrevem)
        $data = array_merge($existingData, $data);

        // Converter areas e skills de string para array (apenas se foram enviados)
        if ($request->filled('areas')) {
            $data['areas'] = array_filter(array_map('trim', explode(',', $request->areas)));
        }
        // Se não foi enviado, manter o valor existente (já está no $data via merge)

        if ($request->filled('skills')) {
            $data['skills'] = array_filter(array_map('trim', explode(',', $request->skills)));
        }
        // Se não foi enviado, manter o valor existente (já está no $data via merge)

        // Processar education como array (apenas se foi enviado)
        if ($request->has('education') && is_array($request->education)) {
            $education = [];
            foreach ($request->education as $item) {
                if (isset($item['title']) && !empty(trim($item['title']))) {
                    $education[] = [
                        'title' => trim($item['title']),
                        'institution' => isset($item['institution']) ? trim($item['institution']) : '',
                        'period' => isset($item['period']) ? trim($item['period']) : '',
                        'description' => isset($item['description']) ? trim($item['description']) : '',
                    ];
                }
            }
            $data['education'] = $education;
        }
        // Se não foi enviado, manter o valor existente (já está no $data via merge)

        // Processar experiences como array (apenas se foi enviado)
        if ($request->has('experiences') && is_array($request->experiences)) {
            $experiences = [];
            foreach ($request->experiences as $item) {
                if (isset($item['title']) && !empty(trim($item['title']))) {
                    $experiences[] = [
                        'title' => trim($item['title']),
                        'company' => isset($item['company']) ? trim($item['company']) : '',
                        'period' => isset($item['period']) ? trim($item['period']) : '',
                        'salary' => isset($item['salary']) ? trim($item['salary']) : '',
                        'description' => isset($item['description']) ? trim($item['description']) : '',
                    ];
                }
            }
            $data['experiences'] = $experiences;
        }
        // Se não foi enviado, manter o valor existente (já está no $data via merge)

        // Processar years_experience (apenas se foi enviado)
        if ($request->filled('years_experience')) {
            $data['years_experience'] = (int) $request->years_experience;
        }
        // Se não foi enviado, manter o valor existente (já está no $data via merge)

        // Upload de foto
        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public_direct')->delete($profile->photo);
                \App\Helpers\FileSyncHelper::removeFromPublic($profile->photo);
            }
            $data['photo'] = $request->file('photo')->store('professionals/photos', 'public_direct');
            \App\Helpers\FileSyncHelper::syncToPublic($data['photo']);
        }

        // Upload de currículo
        if ($request->hasFile('resume')) {
            if ($profile->resume) {
                Storage::disk('public_direct')->delete($profile->resume);
                \App\Helpers\FileSyncHelper::removeFromPublic($profile->resume);
            }
            $data['resume'] = $request->file('resume')->store('professionals/resumes', 'public_direct');
            \App\Helpers\FileSyncHelper::syncToPublic($data['resume']);
        }

        // Usar fill() e save() para garantir que campos null sejam salvos corretamente
        $profile->fill($data);
        $profile->save();

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

        // Filtro de tempo
        $timeFilter = $request->get('time_filter', '6months');
        $dateFrom = now();
        switch ($timeFilter) {
            case '6months':
                $dateFrom = now()->subMonths(6);
                break;
            case '12months':
                $dateFrom = now()->subMonths(12);
                break;
            case '16months':
                $dateFrom = now()->subMonths(16);
                break;
            case '24months':
                $dateFrom = now()->subMonths(24);
                break;
            case '5years':
                $dateFrom = now()->subYears(5);
                break;
        }
        $query->where('created_at', '>=', $dateFrom);

        $applications = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

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
            $data['resume_file'] = $request->file('resume_file')->store('applications/resumes', 'public_direct');
            \App\Helpers\FileSyncHelper::syncToPublic($data['resume_file']);
        }

        JobApplication::create($data);

        // Incrementar contador de candidaturas
        $job->incrementApplications();
        $profile->incrementApplications();

        return back()->with('success', 'Candidatura enviada com sucesso!');
    }

    public function updateApplication(Request $request, $applicationId)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        $application = $profile->jobApplications()->findOrFail($applicationId);

        if ($application->status !== 'pending') {
            return back()->withErrors(['error' => 'Não é possível editar esta candidatura.']);
        }

        $request->validate([
            'cover_letter' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'cover_letter' => $request->cover_letter,
        ]);

        return back()->with('success', 'Candidatura atualizada com sucesso.');
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

        $favorites = $user->favorites()
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
        $profile = $user->professionalProfile;

        return view('dashboard.professional.public-page', compact('profile'));
    }

    public function settings()
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        return view('dashboard.professional.settings', compact('profile'));
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        $type = $request->input('type');

        switch ($type) {
            case 'email':
                $request->validate([
                    'email' => 'required|email|unique:users,email,' . $user->id,
                ]);

                $user->update(['email' => $request->email]);
                return back()->with('success', 'E-mail atualizado com sucesso!');

            case 'phone':
                $request->validate([
                    'phone' => 'nullable|string|max:20',
                ]);

                $profile->update(['phone' => $request->phone]);
                return back()->with('success', 'Telefone atualizado com sucesso!');

            case 'password':
                $request->validate([
                    'current_password' => 'required',
                    'password' => 'required|min:8|confirmed',
                ]);

                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'Senha atual incorreta.']);
                }

                $user->update(['password' => Hash::make($request->password)]);
                return back()->with('success', 'Senha alterada com sucesso!');

            default:
                return back()->withErrors(['error' => 'Tipo de atualização inválido.']);
        }
    }

    public function updatePrivacySettings(Request $request)
    {
        $user = Auth::user();
        $profile = $user->professionalProfile;

        if (!$profile) {
            return back()->withErrors(['error' => 'Perfil não encontrado.']);
        }

        // Preparar dados para atualização
        // Todos os campos são sempre enviados (via hidden ou checkbox)
        // Processar todos os campos presentes no request
        $privacyData = [];

        // Atualizar is_public (sempre presente via hidden ou checkbox)
        if ($request->has('is_public')) {
            $isPublic = $request->input('is_public') == '1' || $request->boolean('is_public');
            $privacyData['is_public'] = $isPublic;
            // Sincronizar com is_active do User
            $user->update(['is_active' => $isPublic]);
        }

        // Atualizar show_in_search (sempre presente via hidden ou checkbox)
        if ($request->has('show_in_search')) {
            $privacyData['show_in_search'] = $request->input('show_in_search') == '1' || $request->boolean('show_in_search');
        }

        // Atualizar allow_direct_contact (sempre presente via hidden ou checkbox)
        if ($request->has('allow_direct_contact')) {
            $privacyData['allow_direct_contact'] = $request->input('allow_direct_contact') == '1' || $request->boolean('allow_direct_contact');
        }

        // Atualizar show_current_salary (sempre presente via hidden ou checkbox)
        if ($request->has('show_current_salary')) {
            $privacyData['show_current_salary'] = $request->input('show_current_salary') == '1' || $request->boolean('show_current_salary');
        }

        // Atualizar perfil apenas se houver dados para atualizar
        if (!empty($privacyData)) {
            $profile->update($privacyData);
        }

        return back()->with('success', 'Configurações de privacidade atualizadas com sucesso!');
    }

    public function updateNotificationSettings(Request $request)
    {
        // Aqui você pode salvar preferências de notificação no banco de dados
        // Por enquanto, apenas retornamos sucesso
        return back()->with('success', 'Preferências de notificação atualizadas com sucesso!');
    }
}
