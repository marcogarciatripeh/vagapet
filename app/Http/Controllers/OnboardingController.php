<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    // Exibe o Passo 1
    public function passo1()
    {
        return view('onboarding.passo1');
    }

    // Processa o Passo 1
    public function passo1Post(Request $request)
    {
        $perfil = $request->input('perfil');
        if ($perfil === 'empresa') {
            return redirect()->route('onboarding.empresa.passo2');
        } else {
            return redirect()->route('onboarding.profissional.passo2');
        }
    }
}
