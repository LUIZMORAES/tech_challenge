<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function ShowDashboard()
    {
//        $Usuarios = User::all();
//
//        dd($Usuarios);
        if (Auth::check()) {

//            dd('teste dentro da checagem auth');

//            dd($user);
//            return view('admin');

            return view('admin.dashboard');
        }

        return redirect()->route('admin.login');
    }

    public function showLoginForm()
    {
        return view('admin.formLogin');
    }

    public function login(Request $request)
    {

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return redirect()->back()->withInput()->withErrors(['O e-mail informado não é válido!']);
        }

        $credenciais = [

          'email'     =>  $request->email,
          'password'  =>  $request->password
        ];

        Auth::attempt($credenciais);


        if(Auth::attempt($credenciais)) {
            return redirect()->route('admin');
        }

        return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem!']);
    }

    public function showLogoutForm()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
