<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        // TODO: No futuro, detectar o tipo real do usuário logado
        $userType = 'professional'; // ou 'company'

        return view('help.index', compact('userType'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        return redirect()->back()->with('success', 'Sua solicitação foi enviada com sucesso!');
    }
}
