<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.company.dashboard');
    }

    public function profile()
    {
        return view('dashboard.company.profile');
    }

    public function manageJobs()
    {
        return view('dashboard.company.manage-jobs');
    }

    public function candidates()
    {
        return view('dashboard.company.candidates');
    }

    public function publicPage()
    {
        return view('dashboard.company.public-page');
    }

    public function favoriteProfessionals()
    {
        return view('dashboard.company.favorite-professionals');
    }

    public function createJob()
    {
        return view('dashboard.company.create-job');
    }

    public function createJobProcess(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'contract_type' => 'required|string',
            'salary' => 'required|string',
            'workload' => 'required|string',
            'experience_level' => 'required|string',
            'work_area' => 'required|string',
            'application_deadline' => 'required|date',
        ]);

        // Aqui você pode adicionar a lógica para salvar a vaga no banco de dados
        // Por enquanto, apenas redirecionamos de volta com uma mensagem de sucesso

        return redirect()->route('company.manage-jobs')->with('success', 'Vaga publicada com sucesso!');
    }

    public function jobs()
    {
        return view('dashboard.company.jobs');
    }
}
