<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
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
        Feedback::create(['feedback' => request()->feedback]);
        return redirect()->back();
    }
}
