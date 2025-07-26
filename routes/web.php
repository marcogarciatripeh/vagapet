<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\Professional\ProfessionalController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\ManageJobsController as CompanyManageJobsController;
use App\Http\Controllers\Company\CandidatesController as CompanyCandidatesController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;
use App\Http\Controllers\Company\PageController as CompanyPageController;
use App\Http\Controllers\Company\ProfileController as CompanyProfileController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [AboutController::class, 'index'])->name('sobre');
Route::get('/contato', [ContactController::class, 'index'])->name('contato');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// Rotas de Autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rotas de Vagas
Route::prefix('vagas')->group(function () {
    Route::get('/', [JobsController::class, 'index'])->name('vagas');
    Route::get('/criar', [JobsController::class, 'create'])->name('vagas.criar');
    Route::get('/alertas', [JobsController::class, 'alerts'])->name('vagas.alertas');
});

// Rotas de Categorias
Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias');

// Área do Profissional
Route::prefix('profissional')->group(function () {
    Route::get('/painel', [ProfessionalController::class, 'dashboard'])->name('profissional.painel');
    Route::get('/favoritos', [ProfessionalController::class, 'favorites'])->name('profissional.favoritos');
    Route::get('/curriculo', [ProfessionalController::class, 'resume'])->name('profissional.curriculo');
    Route::get('/perfil', [ProfessionalController::class, 'profile'])->name('profissional.perfil');
});

// Área da Empresa
Route::prefix('empresa')->group(function () {
    Route::get('/painel', [CompanyDashboardController::class, 'index'])->name('empresa.painel');
    Route::get('/profissionais', [CompanyController::class, 'searchProfessionals'])->name('empresa.profissionais');
    Route::get('/profissionais-favoritos', [CompanyController::class, 'favoriteProfessionals'])->name('empresa.profissionais-favoritos');
    Route::get('/gerenciar-vagas', [CompanyManageJobsController::class, 'index'])->name('empresa.gerenciar-vagas');
    Route::get('/gerenciar-vagas/criar', [CompanyManageJobsController::class, 'create'])->name('empresa.gerenciar-vagas.criar');
    Route::get('/candidatos', [CompanyCandidatesController::class, 'index'])->name('empresa.candidatos');
    Route::get('/pagina', [CompanyPageController::class, 'index'])->name('empresa.pagina');
    Route::get('/perfil', [CompanyProfileController::class, 'index'])->name('empresa.perfil');
});

// Rotas de Busca Pública
Route::prefix('busca')->group(function () {
    Route::get('/empresas', [CompanyController::class, 'searchCompanies'])->name('busca.empresas');
    Route::get('/empresa/{id}/vagas', [CompanyController::class, 'companyJobs'])->name('empresa.vagas');
});

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

// Planos
Route::get('/planos', [CompanyController::class, 'plans'])->name('planos');

// Páginas Institucionais
Route::prefix('paginas')->group(function () {
    Route::get('/mapa-do-site', [PageController::class, 'sitemap'])->name('mapa-do-site');
    Route::get('/termos', [PageController::class, 'terms'])->name('termos');
    Route::get('/privacidade', [PageController::class, 'privacy'])->name('privacidade');
    Route::get('/seguranca', [PageController::class, 'security'])->name('seguranca');
    Route::get('/acessibilidade', [PageController::class, 'accessibility'])->name('acessibilidade');
});

// Página de Alterar Senha (genérica para qualquer usuário)
Route::get('/alterar-senha', [ChangePasswordController::class, 'index'])->name('alterar-senha');

// Rotas autenticadas
// Route::middleware(['auth'])->group(function () {
Route::get('/ajuda', [HelpController::class, 'index'])->name('ajuda');
// });

// Rota de logout temporária para evitar erro de rota indefinida
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Onboarding Passo 1 (comum)
Route::get('/onboarding/passo1', [App\Http\Controllers\OnboardingController::class, 'passo1'])->name('onboarding.passo1');
Route::post('/onboarding/passo1', [App\Http\Controllers\OnboardingController::class, 'passo1Post'])->name('onboarding.passo1.post');

// Onboarding Empresa
Route::prefix('onboarding/empresa')->group(function () {
    Route::get('passo2', fn() => view('onboarding.empresa.passo2'))->name('onboarding.empresa.passo2');
    Route::post('passo2', fn() => redirect()->route('onboarding.empresa.passo3'))->name('onboarding.empresa.passo2.post');
    Route::get('passo3', fn() => view('onboarding.empresa.passo3'))->name('onboarding.empresa.passo3');
    Route::post('passo3', fn() => redirect()->route('onboarding.empresa.passo4'))->name('onboarding.empresa.passo3.post');
    Route::get('passo4', fn() => view('onboarding.empresa.passo4'))->name('onboarding.empresa.passo4');
    Route::post('passo4', fn() => redirect()->route('onboarding.empresa.passo5'))->name('onboarding.empresa.passo4.post');
    Route::get('passo5', fn() => view('onboarding.empresa.passo5'))->name('onboarding.empresa.passo5');
    Route::post('passo5', fn() => redirect()->route('onboarding.empresa.passo6'))->name('onboarding.empresa.passo5.post');
    Route::get('passo6', fn() => view('onboarding.empresa.passo6'))->name('onboarding.empresa.passo6');
    Route::post('passo6', fn() => redirect('/'))->name('onboarding.empresa.passo6.post'); // ou para onde quiser após finalizar
});

// Onboarding Profissional
Route::prefix('onboarding/profissional')->group(function () {
    Route::get('passo2', fn() => view('onboarding.profissional.passo2'))->name('onboarding.profissional.passo2');
    Route::post('passo2', fn() => redirect()->route('onboarding.profissional.passo3'))->name('onboarding.profissional.passo2.post');
    Route::get('passo3', fn() => view('onboarding.profissional.passo3'))->name('onboarding.profissional.passo3');
    Route::post('passo3', fn() => redirect()->route('onboarding.profissional.passo4'))->name('onboarding.profissional.passo3.post');
    Route::get('passo4', fn() => view('onboarding.profissional.passo4'))->name('onboarding.profissional.passo4');
    Route::post('passo4', fn() => redirect()->route('onboarding.profissional.passo5'))->name('onboarding.profissional.passo4.post');
    Route::get('passo5', fn() => view('onboarding.profissional.passo5'))->name('onboarding.profissional.passo5');
    Route::post('passo5', fn() => redirect()->route('onboarding.profissional.passo6'))->name('onboarding.profissional.passo5.post');
    Route::get('passo6', fn() => view('onboarding.profissional.passo6'))->name('onboarding.profissional.passo6');
    Route::post('passo6', fn() => redirect()->route('onboarding.profissional.passo7'))->name('onboarding.profissional.passo6.post');
    Route::get('passo7', fn() => view('onboarding.profissional.passo7'))->name('onboarding.profissional.passo7');
    Route::post('passo7', fn() => redirect('/'))->name('onboarding.profissional.passo7.post'); // ou para onde quiser após finalizar
});
