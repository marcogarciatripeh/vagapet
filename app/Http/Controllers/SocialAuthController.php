<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\ProfessionalProfile;
use App\Models\CompanyProfile;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            return $this->handleSocialCallback($googleUser, 'google');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Erro ao fazer login com Google. Tente novamente.');
        }
    }

    /**
     * Redirect to Facebook
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook callback
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            return $this->handleSocialCallback($facebookUser, 'facebook');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Erro ao fazer login com Facebook. Tente novamente.');
        }
    }

    /**
     * Redirect to Apple
     */
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    /**
     * Handle Apple callback
     */
    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->user();
            return $this->handleSocialCallback($appleUser, 'apple');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Erro ao fazer login com Apple. Tente novamente.');
        }
    }

    /**
     * Handle social callback
     */
    private function handleSocialCallback($socialUser, $provider)
    {
        // Buscar usuário existente
        $existingUser = User::where('email', $socialUser->getEmail())->first();

        if ($existingUser) {
            // Usuário existe, fazer login
            Auth::login($existingUser);

            // Redirecionar baseado no perfil ativo
            if ($existingUser->active_profile === 'professional') {
                return redirect()->route('professional.dashboard');
            } elseif ($existingUser->active_profile === 'company') {
                return redirect()->route('company.dashboard');
            } else {
                return redirect()->route('choose-profile');
            }
        } else {
            // Criar novo usuário
            $user = User::create([
                'name' => $socialUser->getName() ?? 'Usuário',
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(16)), // Senha aleatória
                'active_profile' => null, // Será definido no onboarding
            ]);

            Auth::login($user);

            // Armazenar dados do usuário social na sessão para o onboarding
            session([
                'social_user' => [
                    'provider' => $provider,
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'avatar' => $socialUser->getAvatar(),
                ]
            ]);

            return redirect()->route('onboarding.step1')->with('success', 'Conta criada com sucesso! Complete seu perfil.');
        }
    }
}
