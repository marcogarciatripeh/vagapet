<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfessionalProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        $user = auth()->user();

        if (!$user->hasProfessionalProfile()) {
            return redirect()->route('home')->with('error', 'Você precisa ter um perfil profissional para acessar esta página.');
        }

        // Garantir que o perfil ativo seja professional
        if ($user->active_profile !== 'professional') {
            $user->switchProfile('professional');
        }

        return $next($request);
    }
}
