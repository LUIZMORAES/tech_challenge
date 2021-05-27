<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function session()
    {
        echo "<h1>Teste sessão<h1>" ;

        session(['name' => 'Luiz']);
        echo session('name');

        session()->put('lastname', 'web');
        echo session()->get('lastname');

        //Facedes
        Session::put('email', null);
        echo Session::get('email');

        Session::put(['cart_product' => '1', 'cart_quantidade' => 2, 'preco' => 99]);

        Session::forget(['preco', 'cart_quantidade']);

        if (Session::has('email')){
            echo "<p>O e-mail informado é válido!</p>";
        }else {
            echo "<p>O e-mail informado não é válido!</p>";
        }

        if (Session::exists('email')){
            echo "<p>O e-mail informado é válido!</p>";
        }else {
            echo "<p>O e-mail informado não é válido!</p>";
        }

//        Session::flash('message','O artigo foi criado com sucesso!');
        echo Session::get('message');

        dd(Session::all(), session()->all());
    }
}



