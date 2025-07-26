<?php

namespace App\Http\Controllers;

class OnboardingEmpresaController extends Controller
{
    public function passo1() { return view('onboarding.empresa.passo1'); }
    public function passo2() { return view('onboarding.empresa.passo2'); }
    public function passo3() { return view('onboarding.empresa.passo3'); }
    public function passo4() { return view('onboarding.empresa.passo4'); }
    public function passo5() { return view('onboarding.empresa.passo5'); }
    public function passo6() { return view('onboarding.empresa.passo6'); }
}
