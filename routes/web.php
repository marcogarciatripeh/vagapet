<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Professional\ProfessionalController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HelpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Company\ManageJobsController;
use App\Http\Controllers\Company\CandidatesController;

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
});

// Área da Empresa
Route::prefix('empresa')->group(function () {
    Route::get('/painel', [CompanyController::class, 'dashboard'])->name('empresa.painel');
    Route::get('/profissionais', [CompanyController::class, 'searchProfessionals'])->name('empresa.profissionais');
    Route::get('/gerenciar-vagas', [ManageJobsController::class, 'index'])->name('empresa.gerenciar-vagas');
    Route::get('/candidatos', [CandidatesController::class, 'index'])->name('empresa.candidatos');
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
