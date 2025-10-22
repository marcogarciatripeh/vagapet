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

            if ($existingUser) {
                if ($existingUser->isCompleted()) {
                    // Usuário já completou o cadastro
                    return redirect()->back()->withErrors(['email' => 'Este e-mail já está sendo usado por uma conta completa.'])->withInput();
                } elseif ($existingUser->isPending()) {
                    // Usuário existe mas não completou o cadastro - pode continuar
                }
            }

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
        // Debug: verificar dados da sessão

        return view('onboarding.professional.step2');
    }

    public function step2ProfessionalProcess(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Usar email da sessão
            $email = session('onboarding.email');
            if (!$email) {
                return redirect()->route('onboarding.step0')->with('error', 'Sessão expirada. Tente novamente.');
            }

            // Verificar se já existe um usuário com este email
            $existingUser = User::where('email', $email)->first();

            if ($existingUser && $existingUser->isCompleted()) {
                return redirect()->route('onboarding.step0')->with('error', 'Este e-mail já está sendo usado por uma conta completa.');
            }

            if ($existingUser && $existingUser->isPending()) {
                // Atualizar usuário existente
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
        return view('onboarding.professional.step6');
    }

    public function step6ProfessionalProcess(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:500',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip_code' => 'nullable|string|max:10',
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
        try {
            $request->validate([
                'linkedin' => 'nullable|url',
                'instagram' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'website' => 'nullable|url',
            ]);

            // Debug: verificar dados da sessão

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


            $profile = ProfessionalProfile::create($mappedData);

            // Marcar usuário como completed
            $user->markAsCompleted();

            // Fazer login automático
            Auth::login($user);

            // Limpar sessão
            $this->clearOnboardingSession();

            return redirect()->route('professional.dashboard')->with('success', 'Perfil profissional criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erro ao processar cadastro: ' . $e->getMessage()])->withInput();
        }
    }

    // ========================================
    // ONBOARDING EMPRESA
    // ========================================

    public function step2Company()
    {
        return view('onboarding.company.step2');
    }

    public function step2CompanyProcess(Request $request)
    {
        try {
            $request->validate([
                'company_name' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Usar email da sessão
            $email = session('onboarding.email');
            if (!$email) {
                return redirect()->route('onboarding.step0')->with('error', 'Sessão expirada. Tente novamente.');
            }

            // Verificar se já existe um usuário com este email
            $existingUser = User::where('email', $email)->first();

            if ($existingUser && $existingUser->isCompleted()) {
                return redirect()->route('onboarding.step0')->with('error', 'Este e-mail já está sendo usado por uma conta completa.');
            }

            if ($existingUser && $existingUser->isPending()) {
                // Atualizar usuário existente
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
        return view('onboarding.company.step3');
    }

    public function step3CompanyProcess(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
        ]);

        session(['onboarding.step3_data' => $request->all()]);

        return redirect()->route('onboarding.step4.company');
    }

    public function step4Company()
    {
        return view('onboarding.company.step4');
    }

    public function step4CompanyProcess(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'zip_code' => 'nullable|string|max:10',
        ]);

        session(['onboarding.step4_data' => $request->all()]);

        return redirect()->route('onboarding.step5.company');
    }

    public function step5Company()
    {
        return view('onboarding.company.step5');
    }

    public function step5CompanyProcess(Request $request)
    {
        $request->validate([
            'services' => 'nullable|array',
            'specialties' => 'nullable|array',
            'employees_count' => 'nullable|integer|min:1',
            'company_size' => 'nullable|in:micro,small,medium,large',
        ]);

        session(['onboarding.step5_data' => $request->all()]);

        return redirect()->route('onboarding.step6.company');
    }

    public function step6Company()
    {
        return view('onboarding.company.step6');
    }

    public function step6CompanyProcess(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|max:2048',
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'image|max:2048',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|url',
        ]);

        // Upload de logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('companies/logos', 'public');
        }

        // Upload de fotos
        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('companies/photos', 'public');
            }
        }

        // Criar perfil da empresa com todos os dados
        $userId = session('onboarding.user_id');
        $user = User::findOrFail($userId);

        $profileData = array_merge(
            session('onboarding.step2_data', []),
            session('onboarding.step3_data', []),
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

        CompanyProfile::create($profileData);

        // Marcar usuário como completed
        $user->markAsCompleted();

        // Fazer login automático
        Auth::login($user);

        // Limpar sessão
        $this->clearOnboardingSession();

        return redirect()->route('company.dashboard')->with('success', 'Perfil da empresa criado com sucesso!');
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
        ]);
    }
}
