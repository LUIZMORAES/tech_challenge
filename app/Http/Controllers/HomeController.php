<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//       dd('teste Painel.Principal.Show');

        if (Auth::check()) {

            return view('admin.dashboard');
        }

        return redirect()->route('admin.login');
    }

    public function showPainelPrincipal()
    {

        if (Auth::check()) {

            return view('admin.dashboard');
        }

        return redirect()->route('admin.login');
    }

}
