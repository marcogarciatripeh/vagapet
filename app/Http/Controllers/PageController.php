<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function sitemap()
    {
        return view('pages.sitemap');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function security()
    {
        return view('pages.security');
    }

    public function accessibility()
    {
        return view('pages.accessibility');
    }
}
