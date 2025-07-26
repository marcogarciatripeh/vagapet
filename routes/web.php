<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\Dashboard\ProfessionalController as DashboardProfessionalController;
use App\Http\Controllers\Dashboard\CompanyController as DashboardCompanyController;
use Illuminate\Support\Facades\Route;

// ========================================
// ROTAS PÚBLICAS
// ========================================

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/contato', [PublicController::class, 'contact'])->name('contact');
Route::post('/contato', [PublicController::class, 'contactSend'])->name('contact.send');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/ajuda', [PublicController::class, 'help'])->name('help');
Route::post('/ajuda', [PublicController::class, 'helpSend'])->name('help.send');
Route::get('/precos', [PublicController::class, 'pricing'])->name('pricing');
Route::get('/checkout', [PublicController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [PublicController::class, 'checkoutProcess'])->name('checkout.process');

// Páginas Institucionais
Route::get('/termos', [PublicController::class, 'terms'])->name('terms');
Route::get('/privacidade', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/politica-cookies', [PublicController::class, 'cookies'])->name('cookies');

// Vagas
Route::get('/vagas', [JobController::class, 'index'])->name('jobs.index');
Route::get('/vagas/{id}', [JobController::class, 'show'])->name('jobs.show');

// Empresas
Route::get('/empresas', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/empresas/{id}', [CompanyController::class, 'show'])->name('companies.show');

// Profissionais
Route::get('/profissionais', [ProfessionalController::class, 'index'])->name('professionals.index');
Route::get('/profissionais/{id}', [ProfessionalController::class, 'show'])->name('professionals.show');

// ========================================
// ROTAS DE AUTENTICAÇÃO
// ========================================

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/alterar-senha', [AuthController::class, 'changePassword'])->name('change-password');
Route::post('/alterar-senha', [AuthController::class, 'changePasswordUpdate'])->name('change-password.update');

// ========================================
// ROTAS DE ONBOARDING
// ========================================

Route::prefix('cadastro')->group(function () {
    Route::get('/', [OnboardingController::class, 'step0'])->name('onboarding.step0');
    Route::get('/passo1', [OnboardingController::class, 'step1'])->name('onboarding.step1');
    Route::post('/passo1', [OnboardingController::class, 'step1Process'])->name('onboarding.step1.process');
    Route::get('/passo2-profissional', [OnboardingController::class, 'step2Professional'])->name('onboarding.step2.professional');
    Route::get('/passo2-empresa', [OnboardingController::class, 'step2Company'])->name('onboarding.step2.company');
    Route::get('/passo3-profissional', [OnboardingController::class, 'step3Professional'])->name('onboarding.step3.professional');
    Route::get('/passo3-empresa', [OnboardingController::class, 'step3Company'])->name('onboarding.step3.company');
    Route::get('/passo4-profissional', [OnboardingController::class, 'step4Professional'])->name('onboarding.step4.professional');
    Route::get('/passo4-empresa', [OnboardingController::class, 'step4Company'])->name('onboarding.step4.company');
    Route::get('/passo5-profissional', [OnboardingController::class, 'step5Professional'])->name('onboarding.step5.professional');
    Route::get('/passo5-empresa', [OnboardingController::class, 'step5Company'])->name('onboarding.step5.company');
    Route::get('/passo6-profissional', [OnboardingController::class, 'step6Professional'])->name('onboarding.step6.professional');
    Route::get('/passo6-empresa', [OnboardingController::class, 'step6Company'])->name('onboarding.step6.company');
    Route::get('/passo7-profissional', [OnboardingController::class, 'step7Professional'])->name('onboarding.step7.professional');

    // Rotas POST para processar formulários
    Route::post('/passo2-empresa', [OnboardingController::class, 'step2CompanyProcess'])->name('onboarding.step2.company.process');
    Route::post('/passo3-empresa', [OnboardingController::class, 'step3CompanyProcess'])->name('onboarding.step3.company.process');
    Route::post('/passo4-empresa', [OnboardingController::class, 'step4CompanyProcess'])->name('onboarding.step4.company.process');
    Route::post('/passo5-empresa', [OnboardingController::class, 'step5CompanyProcess'])->name('onboarding.step5.company.process');
    Route::post('/passo6-empresa', [OnboardingController::class, 'step6CompanyProcess'])->name('onboarding.step6.company.process');

    Route::post('/passo2-profissional', [OnboardingController::class, 'step2ProfessionalProcess'])->name('onboarding.step2.professional.process');
    Route::post('/passo3-profissional', [OnboardingController::class, 'step3ProfessionalProcess'])->name('onboarding.step3.professional.process');
    Route::post('/passo4-profissional', [OnboardingController::class, 'step4ProfessionalProcess'])->name('onboarding.step4.professional.process');
    Route::post('/passo5-profissional', [OnboardingController::class, 'step5ProfessionalProcess'])->name('onboarding.step5.professional.process');
    Route::post('/passo6-profissional', [OnboardingController::class, 'step6ProfessionalProcess'])->name('onboarding.step6.professional.process');
    Route::post('/passo7-profissional', [OnboardingController::class, 'step7ProfessionalProcess'])->name('onboarding.step7.professional.process');
});

// ========================================
// DASHBOARD PROFISSIONAL
// ========================================

Route::prefix('profissional')->group(function () {
    Route::get('/painel', [DashboardProfessionalController::class, 'dashboard'])->name('professional.dashboard');
    Route::get('/perfil', [DashboardProfessionalController::class, 'profile'])->name('professional.profile');
    Route::post('/perfil', [DashboardProfessionalController::class, 'profileUpdate'])->name('professional.profile.update');
    Route::get('/candidaturas', [DashboardProfessionalController::class, 'applications'])->name('professional.applications');
    Route::get('/configuracoes', [DashboardProfessionalController::class, 'settings'])->name('professional.settings');
    Route::post('/configuracoes', [DashboardProfessionalController::class, 'settingsUpdate'])->name('professional.settings.update');
    Route::get('/pagina', [DashboardProfessionalController::class, 'publicPage'])->name('professional.public-page');
    Route::get('/favoritos', [DashboardProfessionalController::class, 'favorites'])->name('professional.favorites');
});

// ========================================
// DASHBOARD EMPRESA
// ========================================

Route::prefix('empresa')->group(function () {
    Route::get('/painel', [DashboardCompanyController::class, 'dashboard'])->name('company.dashboard');
    Route::get('/perfil', [DashboardCompanyController::class, 'profile'])->name('company.profile');
    Route::post('/perfil', [DashboardCompanyController::class, 'profileUpdate'])->name('company.profile.update');
    Route::get('/gerenciar-vagas', [DashboardCompanyController::class, 'manageJobs'])->name('company.manage-jobs');
    Route::get('/candidatos', [DashboardCompanyController::class, 'candidates'])->name('company.candidates');
    Route::get('/pagina', [DashboardCompanyController::class, 'publicPage'])->name('company.public-page');
    Route::get('/profissionais-favoritos', [DashboardCompanyController::class, 'favoriteProfessionals'])->name('company.favorite-professionals');
    Route::get('/criar-vaga', [DashboardCompanyController::class, 'createJob'])->name('company.create-job');
    Route::post('/vagas', [DashboardCompanyController::class, 'storeJob'])->name('company.jobs.store');
});

// ========================================
// ROTAS ADICIONAIS
// ========================================

Route::get('/register', [AuthController::class, 'register'])->name('register');
