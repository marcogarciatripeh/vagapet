<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\CompanyProfile;
use App\Models\ProfessionalProfile;
use App\Models\Faq;

class PublicController extends Controller
{
    public function home()
    {
        // Estatísticas para a home
        $stats = [
            'total_jobs' => Job::active()->count(),
            'total_companies' => CompanyProfile::active()->count(),
            'total_professionals' => ProfessionalProfile::active()->count(),
            'total_applications' => \App\Models\JobApplication::count(),
        ];

        // Vagas em destaque
        $featured_jobs = Job::active()
            ->featured()
            ->with('companyProfile')
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        // Vagas recentes
        $recent_jobs = Job::active()
            ->with('companyProfile')
            ->orderBy('published_at', 'desc')
            ->limit(8)
            ->get();

        // Empresas em destaque
        $featured_companies = CompanyProfile::active()
            ->where('views_count', '>', 0)
            ->orderBy('views_count', 'desc')
            ->limit(6)
            ->get();

        return view('public.home', compact('stats', 'featured_jobs', 'recent_jobs', 'featured_companies'));
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function faq()
    {
        $faqs = Faq::active()
            ->ordered()
            ->get()
            ->groupBy('category');

        return view('public.faq', compact('faqs'));
    }

    public function help()
    {
        return view('public.help');
    }

    public function manual()
    {
        return view('public.manual');
    }

    public function terms()
    {
        return view('public.terms');
    }

    public function privacy()
    {
        return view('public.privacy');
    }

    public function cookies()
    {
        return view('public.cookies');
    }

    public function helpSend(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Aqui você pode implementar o envio de email
        // Por exemplo, usando Mail::send() ou uma fila

        return back()->with('success', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
    }
}
