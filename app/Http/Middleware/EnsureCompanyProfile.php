<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCompanyProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'error' => 'Você precisa estar logado para acessar esta página.'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        $user = auth()->user();

        if (!$user->hasCompanyProfile()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'error' => 'Você precisa ter um perfil de empresa para acessar esta página.'
                ], 403);
            }
            return redirect()->route('home')->with('error', 'Você precisa ter um perfil de empresa para acessar esta página.');
        }

        // Garantir que o perfil ativo seja company
        if ($user->active_profile !== 'company') {
            $user->switchProfile('company');
        }

        return $next($request);
    }
}
