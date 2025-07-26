<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $profileType = $request->input('profile_type');

        if ($profileType === 'company') {
            return redirect()->route('onboarding.step2.company');
        } else {
            return redirect()->route('onboarding.step2.professional');
        }
    }

    public function step2Professional()
    {
        return view('onboarding.professional.step2');
    }

    public function step2Company()
    {
        return view('onboarding.company.step2');
    }

    public function step3Professional()
    {
        return view('onboarding.professional.step3');
    }

    public function step3Company()
    {
        return view('onboarding.company.step3');
    }

    public function step4Professional()
    {
        return view('onboarding.professional.step4');
    }

    public function step4Company()
    {
        return view('onboarding.company.step4');
    }

    public function step5Professional()
    {
        return view('onboarding.professional.step5');
    }

    public function step5Company()
    {
        return view('onboarding.company.step5');
    }

    public function step6Professional()
    {
        return view('onboarding.professional.step6');
    }

    public function step6Company()
    {
        return view('onboarding.company.step6');
    }

    public function step7Professional()
    {
        return view('onboarding.professional.step7');
    }

    // Métodos de processamento para Empresa
    public function step2CompanyProcess(Request $request)
    {
        // Processar dados do step2 da empresa
        return redirect()->route('onboarding.step3.company');
    }

    public function step3CompanyProcess(Request $request)
    {
        // Processar dados do step3 da empresa
        return redirect()->route('onboarding.step4.company');
    }

    public function step4CompanyProcess(Request $request)
    {
        // Processar dados do step4 da empresa
        return redirect()->route('onboarding.step5.company');
    }

    public function step5CompanyProcess(Request $request)
    {
        // Processar dados do step5 da empresa
        return redirect()->route('onboarding.step6.company');
    }

    public function step6CompanyProcess(Request $request)
    {
        // Processar dados do step6 da empresa e finalizar cadastro
        return redirect()->route('company.dashboard');
    }

    // Métodos de processamento para Profissional
    public function step2ProfessionalProcess(Request $request)
    {
        // Processar dados do step2 do profissional
        return redirect()->route('onboarding.step3.professional');
    }

    public function step3ProfessionalProcess(Request $request)
    {
        // Processar dados do step3 do profissional
        return redirect()->route('onboarding.step4.professional');
    }

    public function step4ProfessionalProcess(Request $request)
    {
        // Processar dados do step4 do profissional
        return redirect()->route('onboarding.step5.professional');
    }

    public function step5ProfessionalProcess(Request $request)
    {
        // Processar dados do step5 do profissional
        return redirect()->route('onboarding.step6.professional');
    }

    public function step6ProfessionalProcess(Request $request)
    {
        // Processar dados do step6 do profissional
        return redirect()->route('onboarding.step7.professional');
    }

    public function step7ProfessionalProcess(Request $request)
    {
        // Processar dados do step7 do profissional e finalizar cadastro
        return redirect()->route('professional.dashboard');
    }
}
