<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function diagnosis()
    {
        return view('pages.diagnosis');
    }

    public function doctors()
    {
        return view('pages.doctors');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function feedback()
    {
        
        return redirect()->back();
    }
}
