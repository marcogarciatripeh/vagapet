<?php

use Illuminate\Support\Facades\Route;

// Rotas de teste do App2
Route::prefix('app2')->group(function () {

    // Páginas Públicas
    Route::get('/', function () {
        return view('app2.public.home');
    })->name('app2.home');

    Route::get('/contato', function () {
        return view('app2.public.contact');
    })->name('app2.contact');

    Route::get('/vagas', function () {
        return view('app2.public.jobs.index');
    })->name('app2.jobs');

    Route::get('/sobre', function () {
        return view('app2.pages.about');
    })->name('app2.about');

    Route::get('/ajuda', function () {
        return view('app2.pages.help');
    })->name('app2.help');

    // Páginas Institucionais
    Route::get('/termos', function () {
        return view('app2.pages.terms');
    })->name('app2.terms');

    Route::get('/privacidade', function () {
        return view('app2.pages.privacy');
    })->name('app2.privacy');

    // Dashboard Profissional
    Route::get('/profissional/painel', function () {
        return view('app2.dashboard.professional.index');
    })->name('app2.professional.dashboard');

    Route::get('/profissional/perfil', function () {
        return view('app2.dashboard.professional.profile');
    })->name('app2.professional.profile');

    // Dashboard Empresa
    Route::get('/empresa/painel', function () {
        return view('app2.dashboard.company.index');
    })->name('app2.company.dashboard');

    Route::get('/empresa/perfil', function () {
        return view('app2.dashboard.company.profile');
    })->name('app2.company.profile');
});
