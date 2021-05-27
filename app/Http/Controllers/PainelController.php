<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class PainelController extends Controller
{

    public $request;
    public $usuarios;

    public function __construct(Request $request, User $usuarios)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
    }

    public function showUsuarios()
    {
        dd('showUsuarios');
//        if (Auth::check()) {
//
//            $user = Auth::check();
//
//            $uri = $this->request->route()->uri();
////            dd($this->request->route()->uri());
//
//            $exploder = explode('/',$uri);
//
//            $urlAtual = $exploder[1];
//
//            $usuarios = $this->usuarios->all();
//
//            return view('Painel.Usuarios.index', compact('user','urlAtual','usuarios'));
//        }
//
//        return redirect()->route('admin.login');
    }

}
