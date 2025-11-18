<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ProfessionalProfile;
use App\Models\CompanyProfile;
use App\Helpers\BrazilianStates;

class OnboardingController extends Controller
{
    public function step0()
    {
        return view('onboarding.step0');
    }

    public function step1()
    {
        return view('onboarding.step1');
    }

    public function step1Process(Request $request)
    {

        try {
            $request->validate([
                'whatsapp' => 'required|string|max:20',
                'email' => 'required|email',
            ]);

            // Verificar se já existe um usuário com este email
            $existingUser = User::where('email', $request->email)->first();

            // Permite continuar mesmo se o usuário já existe (pode estar criando segundo perfil)
            // A validação se já tem o perfil será feita no step2 específico

            // Salvar dados na sessão para próximos passos
            session([
                'onboarding.whatsapp' => $request->whatsapp,
                'onboarding.email' => $request->email,
            ]);


            return redirect()->route('onboarding.step1');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao processar cadastro: ' . $e->getMessage()])->withInput();
        }
    }

    public function step1ProfileProcess(Request $request)
    {
        $request->validate([
            'profile_type' => 'required|in:professional,company',
        ]);

        // Verificar se o usuário já possui o perfil escolhido
        $email = session('onboarding.email');
        $existingUser = null;

        if ($email) {
            $existingUser = User::where('email', $email)->first();
        }

        // Se não encontrou por sessão, verificar se está autenticado
        if (!$existingUser && Auth::check()) {
            $existingUser = Auth::user();
            // Salvar o email na sessão para manter consistência
            session(['onboarding.email' => $existingUser->email]);
        }

        if ($existingUser) {
            // Forçar refresh das relações do banco
            $existingUser->refresh();
            $hasProfessional = \App\Models\ProfessionalProfile::where('user_id', $existingUser->id)->exists();
            $hasCompany = \App\Models\CompanyProfile::where('user_id', $existingUser->id)->exists();

            if ($request->profile_type === 'professional' && $hasProfessional) {
                return redirect()->route('onboarding.step1')
                    ->withErrors(['profile_type' => 'Você já possui um perfil profissional cadastrado.'])
                    ->withInput();
            }

            if ($request->profile_type === 'company' && $hasCompany) {
                return redirect()->route('onboarding.step1')
                    ->withErrors(['profile_type' => 'Você já possui um perfil de empresa cadastrado.'])
                    ->withInput();
            }
        }

        // Salvar o tipo de perfil na sessão
        session(['onboarding.profile_type' => $request->profile_type]);

        if ($request->profile_type === 'company') {
            return redirect()->route('onboarding.step2.company');
        } else {
            return redirect()->route('onboarding.step2.professional');
        }
    }

    // ========================================
    // ONBOARDING PROFISSIONAL
    // ========================================

    public function step2Professional()
    {
        // Verificar se já existe usuário completo (criando segundo perfil)
        $email = session('onboarding.email');
        $existingUser = null;
        if ($email) {
            $existingUser = User::where('email', $email)->first();
        }

        return view('onboarding.professional.step2', [
            'existingUser' => $existingUser,
            'needsPassword' => !$existingUser || !$existingUser->isCompleted(),
        ]);
    }

    public function step2ProfessionalProcess(Request $request)
    {
        try {
            // Usar email da sessão
            $email = session('onboarding.email');
            if (!$email) {
                return redirect()->route('onboarding.step0')->with('error', 'Sessão expirada. Tente novamente.');
            }

            // Verificar se já existe um usuário com este email
            $existingUser = User::where('email', $email)->first();
            $needsPassword = !$existingUser || !$existingUser->isCompleted();

            // Validação condicional: só exige senha se não tem usuário completo
            $validationRules = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
            ];

            if ($needsPassword) {
                $validationRules['password'] = 'required|string|min:8|confirmed';
            }

            $request->validate($validationRules);

            if ($existingUser && $existingUser->isCompleted()) {
                // Usuário já existe e está completo - apenas atualizar nome e perfil ativo, não alterar senha
                $existingUser->update([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'active_profile' => 'professional',
                ]);
                $user = $existingUser;
            } elseif ($existingUser) {
                // Usuário existe mas está pendente - atualizar com senha
                $existingUser->update([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'password' => Hash::make($request->password),
                    'active_profile' => 'professional',
                    'status' => 'pending',
                ]);
                $user = $existingUser;
            } else {
                // Criar novo usuário
                $user = User::create([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $email,
                    'password' => Hash::make($request->password),
                    'active_profile' => 'professional',
                    'status' => 'pending',
                ]);
            }

            // Salvar dados na sessão para próximos passos
            session([
                'onboarding.user_id' => $user->id,
                'onboarding.step2_data' => $request->except(['password', 'password_confirmation']),
            ]);

            Auth::login($user);

            return redirect()->route('onboarding.step3.professional');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao processar cadastro: ' . $e->getMessage()])->withInput();
        }
    }

    public function step3Professional()
    {
        // Debug: verificar dados da sessão

        return view('onboarding.professional.step3');
    }

    public function step3ProfessionalProcess(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'work_areas' => 'nullable|array',
            'description' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Processar upload de foto se houver
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('professionals/photos', 'public');
            session(['onboarding.photo' => $photoPath]);
        }

        $step3Data = $request->except(['photo']);
        session(['onboarding.step3_data' => $step3Data]);

        return redirect()->route('onboarding.step4.professional');
    }

    public function step4Professional()
    {
        // Debug: verificar dados da sessão

        $step4Data = session('onboarding.step4_data', []);
        return view('onboarding.professional.step4', compact('step4Data'));
    }

    public function step4ProfessionalProcess(Request $request)
    {
        $request->validate([
            'formations' => 'nullable|array',
            'formations.*.title' => 'nullable|string|max:255',
            'formations.*.institution' => 'nullable|string|max:255',
            'formations.*.period' => 'nullable|string|max:50',
            'formations.*.description' => 'nullable|string|max:500',
        ]);

        session(['onboarding.step4_data' => $request->all()]);

        return redirect()->route('onboarding.step5.professional');
    }

    public function step5Professional()
    {
        // Debug: verificar dados da sessão

        $step5Data = session('onboarding.step5_data', []);
        return view('onboarding.professional.step5', compact('step5Data'));
    }

    public function step5ProfessionalProcess(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string|max:1000',
            'areas' => 'nullable|array',
            'skills' => 'nullable|array',
            'years_experience' => 'nullable|integer|min:0',
            'experiences' => 'nullable|array',
            'experiences.*.title' => 'nullable|string|max:255',
            'experiences.*.company' => 'nullable|string|max:255',
            'experiences.*.period' => 'nullable|string|max:50',
            'experiences.*.description' => 'nullable|string|max:500',
        ]);

        session(['onboarding.step5_data' => $request->all()]);

        return redirect()->route('onboarding.step6.professional');
    }

    public function step6Professional()
    {
        $step6Data = session('onboarding.step6_data', []);
        $states = BrazilianStates::getStates();
        return view('onboarding.professional.step6', compact('step6Data', 'states'));
    }

    public function step6ProfessionalProcess(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => ['required', 'string', 'max:2', function ($attribute, $value, $fail) {
                if (!BrazilianStates::isValid($value)) {
                    $fail('O estado selecionado é inválido.');
                }
            }],
            'zip_code' => 'required|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        session(['onboarding.step6_data' => $request->all()]);

        return redirect()->route('onboarding.step7.professional');
    }

    public function step7Professional()
    {
        return view('onboarding.professional.step7');
    }

    public function step7ProfessionalProcess(Request $request)
    {
        $userId = null;
        try {
            $request->validate([
                'linkedin' => 'nullable|url',
                'instagram' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'website' => 'nullable|url',
            ]);

            // Criar perfil profissional com todos os dados
            $userId = session('onboarding.user_id');
            if (!$userId) {
                return redirect()->route('onboarding.step0')->with('error', 'Sessão expirada. Tente novamente.');
            }

            $user = User::findOrFail($userId);

            $profileData = array_merge(
                session('onboarding.step2_data', []),
                session('onboarding.step3_data', []),
                session('onboarding.step4_data', []),
                session('onboarding.step5_data', []),
                session('onboarding.step6_data', []),
                $request->all(),
                [
                    'user_id' => $userId,
                    'phone' => session('onboarding.whatsapp'), // Mapear WhatsApp para phone
                    'photo' => session('onboarding.photo'),
                    'resume' => session('onboarding.resume'),
                ]
            );


            // Mapear nomes dos campos do site para os nomes do banco
            $mappedData = [
                'user_id' => $profileData['user_id'] ?? null,
                'first_name' => $profileData['first_name'] ?? null,
                'last_name' => $profileData['last_name'] ?? null,
                'phone' => $profileData['phone'] ?? null,
                'title' => $profileData['title'] ?? null,
                'experience_level' => $profileData['experience'] ?? null, // Mapear 'experience' → 'experience_level'
                'areas' => $profileData['work_areas'] ?? null, // Mapear 'work_areas' → 'areas'
                'bio' => $profileData['description'] ?? null, // Mapear 'description' → 'bio'
                'education' => $profileData['formations'] ?? null, // Mapear 'formations' → 'education'
                'experiences' => $profileData['experiences'] ?? null,
                'photo' => $profileData['photo'] ?? null,
                'resume' => $profileData['resume'] ?? null,
                'address' => $profileData['address'] ?? null,
                'neighborhood' => $profileData['neighborhood'] ?? null,
                'city' => $profileData['city'] ?? null,
                'state' => $profileData['state'] ?? null,
                'zip_code' => $profileData['zip_code'] ?? null,
                'latitude' => $profileData['latitude'] ?? null,
                'longitude' => $profileData['longitude'] ?? null,
                'linkedin' => $profileData['linkedin'] ?? null,
                'instagram' => $profileData['instagram'] ?? null,
                'facebook' => $profileData['facebook'] ?? null,
                'website' => $profileData['website'] ?? null,
            ];


            // Verificar se já existe perfil para este usuário
            $existingProfile = ProfessionalProfile::where('user_id', $userId)->first();

            if ($existingProfile) {
                // Atualizar perfil existente
                $existingProfile->update($mappedData);
                $profile = $existingProfile;
            } else {
                // Criar novo perfil
                // Garantir que campos obrigatórios estejam presentes
                if (empty($mappedData['first_name']) || empty($mappedData['last_name'])) {
                    return redirect()->back()
                        ->withErrors(['error' => 'Nome e sobrenome são obrigatórios. Por favor, preencha os dados anteriores.'])
                        ->withInput();
                }

                $profile = ProfessionalProfile::create($mappedData);
            }

            // Marcar usuário como completed apenas se ainda não está (primeiro perfil)
            // Se já está completed, significa que está criando o segundo perfil
            if ($user->isPending()) {
                $user->markAsCompleted();
            }

            // Fazer login automático
            Auth::login($user);

            // Limpar sessão
            $this->clearOnboardingSession();

            return redirect()->route('professional.dashboard')->with('success', 'Perfil profissional criado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log do erro para debug
            \Log::error('Erro ao processar cadastro profissional', [
                'user_id' => $userId ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Erro ao processar cadastro. Por favor, tente novamente. Se o problema persistir, entre em contato com o suporte.'])
                ->withInput();
        }
    }

    // ========================================
    // ONBOARDING EMPRESA
    // ========================================

    public function step2Company()
    {
        // Verificar se já existe usuário completo (criando segundo perfil)
        $email = session('onboarding.email');
        $existingUser = null;
        if ($email) {
            $existingUser = User::where('email', $email)->first();
        }

        $step2Data = session('onboarding.step2_data', []);

        return view('onboarding.company.step2', [
            'existingUser' => $existingUser,
            'needsPassword' => !$existingUser || !$existingUser->isCompleted(),
            'step2Data' => $step2Data,
        ]);
    }

    public function step2CompanyProcess(Request $request)
    {
        try {
            // Usar email da sessão
            $email = session('onboarding.email');
            if (!$email) {
                return redirect()->route('onboarding.step0')->with('error', 'Sessão expirada. Tente novamente.');
            }

            // Verificar se já existe um usuário com este email
            $existingUser = User::where('email', $email)->first();
            $needsPassword = !$existingUser || !$existingUser->isCompleted();

            // Validação condicional: só exige senha se não tem usuário completo
            $validationRules = [
                'company_name' => 'required|string|max:255',
            ];

            if ($needsPassword) {
                $validationRules['password'] = 'required|string|min:8|confirmed';
            }

            $request->validate($validationRules);

            if ($existingUser && $existingUser->isCompleted()) {
                // Usuário já existe e está completo - apenas atualizar nome e perfil ativo, não alterar senha
                $existingUser->update([
                    'name' => $request->company_name,
                    'active_profile' => 'company',
                ]);
                $user = $existingUser;
            } elseif ($existingUser) {
                // Usuário existe mas está pendente - atualizar com senha
                $existingUser->update([
                    'name' => $request->company_name,
                    'password' => Hash::make($request->password),
                    'active_profile' => 'company',
                    'status' => 'pending',
                ]);
                $user = $existingUser;
            } else {
                // Criar novo usuário
                $user = User::create([
                    'name' => $request->company_name,
                    'email' => $email,
                    'password' => Hash::make($request->password),
                    'active_profile' => 'company',
                    'status' => 'pending',
                ]);
            }

            // Salvar dados na sessão para próximos passos
            session([
                'onboarding.user_id' => $user->id,
                'onboarding.step2_data' => $request->except(['password', 'password_confirmation']),
            ]);

            Auth::login($user);

            return redirect()->route('onboarding.step3.company');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao processar cadastro: ' . $e->getMessage()])->withInput();
        }
    }

    public function step3Company()
    {
        $step3Data = session('onboarding.step3_data', []);
        return view('onboarding.company.step3', compact('step3Data'));
    }

    public function step3CompanyProcess(Request $request)
    {
        $request->validate([
            'website' => 'nullable|url|max:255',
            'employees' => 'nullable|string',
            'description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|max:2048',
            'attachments' => 'nullable|array',
            'attachments.*' => 'image|max:2048',
        ]);

        // Processar upload de logo se houver (pode vir como 'logo' ou 'attachments')
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('companies/logos', 'public');
            session(['onboarding.logo' => $logoPath]);
        } elseif ($request->hasFile('attachments') && count($request->file('attachments')) > 0) {
            // Se vier no formato attachments[], pegar o primeiro arquivo como logo
            $logoPath = $request->file('attachments')[0]->store('companies/logos', 'public');
            session(['onboarding.logo' => $logoPath]);
        }

        $step3Data = $request->except(['logo', 'attachments']);

        // Manter 'employees' na sessão para poder recuperar quando voltar
        // O mapeamento para 'employees_count' será feito apenas na criação final
        session(['onboarding.step3_data' => $step3Data]);

        return redirect()->route('onboarding.step4.company');
    }

    public function step4Company()
    {
        $step4Data = session('onboarding.step4_data', []);
        $states = BrazilianStates::getStates();
        return view('onboarding.company.step4', compact('step4Data', 'states'));
    }

    public function step4CompanyProcess(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => ['required', 'string', 'max:2', function ($attribute, $value, $fail) {
                if (!BrazilianStates::isValid($value)) {
                    $fail('O estado selecionado é inválido.');
                }
            }],
            'zip_code' => 'required|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        session(['onboarding.step4_data' => $request->all()]);

        return redirect()->route('onboarding.step5.company');
    }

    public function step5Company()
    {
        $step5Data = session('onboarding.step5_data', []);
        return view('onboarding.company.step5', compact('step5Data'));
    }

    public function step5CompanyProcess(Request $request)
    {
        $request->validate([
            'services' => 'nullable|string',
            'specialties' => 'nullable|string',
            'employees_count' => 'nullable|integer|min:1',
            'company_size' => 'nullable|in:micro,small,medium,large',
        ]);

        $step5Data = $request->all();

        // Converter services e specialties de string (separado por vírgula) para array
        if (isset($step5Data['services']) && is_string($step5Data['services'])) {
            $step5Data['services'] = array_filter(array_map('trim', explode(',', $step5Data['services'])));
        }

        if (isset($step5Data['specialties']) && is_string($step5Data['specialties'])) {
            $step5Data['specialties'] = array_filter(array_map('trim', explode(',', $step5Data['specialties'])));
        }

        session(['onboarding.step5_data' => $step5Data]);

        return redirect()->route('onboarding.step6.company');
    }

    public function step6Company()
    {
        $step6Data = session('onboarding.step6_data', []);
        return view('onboarding.company.step6', compact('step6Data'));
    }

    public function step6CompanyProcess(Request $request)
    {
        $request->validate([
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'image|max:2048',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        try {
            // Logo já foi enviado no step3, usar da sessão
            $logoPath = session('onboarding.logo');

            // Upload de fotos (usar da sessão se já foram enviadas, senão processar novas)
            $photos = session('onboarding.photos', []);
            if ($request->hasFile('photos')) {
                $newPhotos = [];
                foreach ($request->file('photos') as $photo) {
                    $newPhotos[] = $photo->store('companies/photos', 'public');
                }
                $photos = array_merge($photos, $newPhotos);
                // Limitar a 5 fotos
                $photos = array_slice($photos, 0, 5);
                session(['onboarding.photos' => $photos]);
            }

            // Salvar dados do step6 na sessão antes de criar o perfil
            $step6Data = $request->except(['logo', 'photos']);
            session(['onboarding.step6_data' => $step6Data]);

            // Criar perfil da empresa com todos os dados
            $userId = session('onboarding.user_id');
            $user = User::findOrFail($userId);

            // Preparar dados do step3 (incluir company_name do step2 se não estiver no step3)
            $step3Data = session('onboarding.step3_data', []);
            if (!isset($step3Data['company_name'])) {
                $step2Data = session('onboarding.step2_data', []);
                if (isset($step2Data['company_name'])) {
                    $step3Data['company_name'] = $step2Data['company_name'];
                }
            }

            // Mapear 'employees' para 'employees_count' na criação final
            if (isset($step3Data['employees']) && !isset($step3Data['employees_count'])) {
                $employeesMapping = [
                    'ate4' => 4,
                    '5a10' => 10,
                    '11a20' => 20,
                    'acima21' => 50,
                ];
                $step3Data['employees_count'] = $employeesMapping[$step3Data['employees']] ?? null;
            }

            $profileData = array_merge(
                session('onboarding.step2_data', []),
                $step3Data,
                session('onboarding.step4_data', []),
                session('onboarding.step5_data', []),
                $request->except(['logo', 'photos']),
                [
                    'user_id' => $userId,
                    'phone' => session('onboarding.whatsapp'), // Mapear WhatsApp para phone
                    'logo' => $logoPath,
                    'photos' => $photos,
                ]
            );

            // Mapear campos corretamente
            $mappedData = [
                'user_id' => $profileData['user_id'] ?? null,
                'company_name' => $profileData['company_name'] ?? null,
                'cnpj' => $profileData['cnpj'] ?? null,
                'phone' => $profileData['phone'] ?? null,
                'website' => $profileData['website'] ?? null,
                'description' => $profileData['description'] ?? null,
                'address' => $profileData['address'] ?? null,
                'city' => $profileData['city'] ?? null,
                'state' => $profileData['state'] ?? null,
                'zip_code' => $profileData['zip_code'] ?? null,
                'latitude' => $profileData['latitude'] ?? null,
                'longitude' => $profileData['longitude'] ?? null,
                'services' => $profileData['services'] ?? null,
                'specialties' => $profileData['specialties'] ?? null,
                'employees_count' => $profileData['employees_count'] ?? null,
                'company_size' => $profileData['company_size'] ?? null,
                'logo' => $profileData['logo'] ?? null,
                'photos' => $profileData['photos'] ?? null,
                'linkedin' => $profileData['linkedin'] ?? null,
                'instagram' => $profileData['instagram'] ?? null,
                'facebook' => $profileData['facebook'] ?? null,
                'youtube' => $profileData['youtube'] ?? null,
            ];

            CompanyProfile::create($mappedData);

            // Marcar usuário como completed apenas se ainda não está (primeiro perfil)
            // Se já está completed, significa que está criando o segundo perfil
            if ($user->isPending()) {
                $user->markAsCompleted();
            }

            // Fazer login automático
            Auth::login($user);

            // Limpar sessão
            $this->clearOnboardingSession();

            return redirect()->route('company.dashboard')->with('success', 'Perfil da empresa criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao processar cadastro: ' . $e->getMessage()])->withInput();
        }
    }

    // ========================================
    // MÉTODOS AUXILIARES
    // ========================================

    private function clearOnboardingSession()
    {
        session()->forget([
            'onboarding.user_id',
            'onboarding.profile_type',
            'onboarding.whatsapp',
            'onboarding.email',
            'onboarding.step2_data',
            'onboarding.step3_data',
            'onboarding.step4_data',
            'onboarding.step5_data',
            'onboarding.step6_data',
            'onboarding.photo',
            'onboarding.resume',
            'onboarding.logo',
            'onboarding.photos',
        ]);
    }
}
