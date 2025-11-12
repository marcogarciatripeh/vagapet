<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        // Se o usuário já está logado, redirecionar para o dashboard apropriado
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->active_profile === 'professional') {
                return redirect()->route('professional.dashboard');
            } elseif ($user->active_profile === 'company') {
                return redirect()->route('company.dashboard');
            } else {
                return redirect()->route('choose-profile');
            }
        }
        
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Sua conta está inativa. Entre em contato com o suporte.']);
            }

            $request->session()->regenerate();

            // Redirecionar baseado no perfil ativo
            $hasProfessional = $user->hasProfessionalProfile();
            $hasCompany = $user->hasCompanyProfile();
            
            // Se tem ambos os perfis, usar o active_profile
            if ($hasProfessional && $hasCompany) {
                if ($user->active_profile === 'company') {
                    return redirect()->intended(route('company.dashboard'));
                } else {
                    // Default para professional se não tiver active_profile definido
                    return redirect()->intended(route('professional.dashboard'));
                }
            }
            
            // Se tem apenas um perfil, redirecionar para ele
            if ($hasCompany) {
                $user->update(['active_profile' => 'company']);
                return redirect()->intended(route('company.dashboard'));
            } elseif ($hasProfessional) {
                $user->update(['active_profile' => 'professional']);
                return redirect()->intended(route('professional.dashboard'));
            }
            
            // Se não tem nenhum perfil completo, redirecionar para home
            return redirect()->route('home')->with('info', 'Complete seu perfil para acessar o painel.');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logout realizado com sucesso.');
    }

    public function switchProfile(Request $request)
    {
        $request->validate([
            'profile' => 'required|in:professional,company'
        ]);

        $user = Auth::user();
        $profile = $request->profile;

        // Verificar se o usuário tem o perfil solicitado
        if ($profile === 'professional' && !$user->hasProfessionalProfile()) {
            return back()->withErrors(['profile' => 'Você não possui um perfil profissional.']);
        }

        if ($profile === 'company' && !$user->hasCompanyProfile()) {
            return back()->withErrors(['profile' => 'Você não possui um perfil de empresa.']);
        }

        $user->switchProfile($profile);

        // Redirecionar para o dashboard apropriado
        if ($profile === 'professional') {
            return redirect()->route('professional.dashboard')->with('success', 'Perfil alterado para profissional.');
        } else {
            return redirect()->route('company.dashboard')->with('success', 'Perfil alterado para empresa.');
        }
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Senha atual incorreta.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Senha alterada com sucesso.');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
