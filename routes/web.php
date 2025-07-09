<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HelpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;

// Rotas Públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// Rotas de Autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rotas de Vagas
Route::prefix('jobs')->group(function () {
    Route::get('/', [JobsController::class, 'index'])->name('jobs');
    Route::get('/create', [JobsController::class, 'create'])->name('jobs.create');
    Route::get('/alerts', [JobsController::class, 'alerts'])->name('job.alerts');
});

// Rotas de Categorias
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

// Área do Profissional
Route::prefix('professional')->group(function () {
    Route::get('/dashboard', [ProfessionalController::class, 'dashboard'])->name('professional.dashboard');
    Route::get('/favorites', [ProfessionalController::class, 'favorites'])->name('favorites');
    Route::get('/resume', [ProfessionalController::class, 'resume'])->name('resume');
});

// Área da Empresa
Route::prefix('company')->group(function () {
    Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('company.dashboard');
    Route::get('/professionals', [CompanyController::class, 'searchProfessionals'])->name('professionals.search');
});

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

// Planos
Route::get('/plans', [CompanyController::class, 'plans'])->name('plans');

// Páginas Institucionais
Route::prefix('pages')->group(function () {
    Route::get('/sitemap', [PageController::class, 'sitemap'])->name('sitemap');
    Route::get('/terms', [PageController::class, 'terms'])->name('terms');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/security', [PageController::class, 'security'])->name('security');
    Route::get('/accessibility', [PageController::class, 'accessibility'])->name('accessibility');
});

// Página de Alterar Senha (genérica para qualquer usuário)
Route::get('/alterar-senha', [ChangePasswordController::class, 'index'])->name('alterar-senha');

// Rotas autenticadas
// Route::middleware(['auth'])->group(function () {
    Route::get('/help', [HelpController::class, 'index'])->name('help');
// });
