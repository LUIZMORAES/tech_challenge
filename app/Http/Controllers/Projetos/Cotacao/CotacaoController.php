<?php

namespace App\Http\Controllers\Projetos\Cotacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use PDF;
use App\Http\Controllers\EmployeeController;



class CotacaoController extends Controller
{
    public $request;
    public $usuarios;
    public $response;

    public function __construct(Request $request, User $usuarios, Request $response)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->request = $response;
    }

    public function index()
    {
//        dd('teste index cotacão!');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();
//            dd($this->request->route()->uri());

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $usuarios = $this->usuarios->all();

            return view('Projetos.Cotacao.index', compact('user','urlAtual','usuarios'));
        }

        return redirect()->route('admin.login');

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function buscarmoeda()
    {

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();
//            dd($this->request->route()->uri());

            $exploder = explode('/', $uri);

            $urlAtual = $exploder[1];

            try {

                $response = Http::get("https://economia.awesomeapi.com.br/json/daily/USD-BRL/1")->throw()->json();
                $collection = collect($response);
                $moedaUnica = $collection->unique('code');
                $ContaMoedatUnica = $collection->countBy('code');

                return view('Projetos.Cotacao.index', compact('user', 'urlAtual'),
                    [
                        'moeda_colecao_u' => $moedaUnica,
                        'conta_moeda_u' => $ContaMoedatUnica,
                    ]);


            } catch (\Throwable $exception) {

                return redirect()->back()->with('erro', 'Moeda não localizado');

            }
        }
    }

    public function buscarmoeda15()
        {

         if (Auth::check()) {

             $user = Auth::check();

             $uri = $this->request->route()->uri();
//            dd($this->request->route()->uri());

             $exploder = explode('/', $uri);

             $urlAtual = $exploder[1];

             try {

                 $response = Http::get("https://economia.awesomeapi.com.br/json/daily/USD-BRL/15")->json();
                 $collection = collect($response);
                 $colecao = $collection;

                 return view('Projetos.Cotacao.listar', compact('user', 'urlAtual'),
                     [
                         'moeda_c_m' => $colecao,
                     ]);

             } catch (\Throwable $exception) {

                 return redirect()->back()->with('erro', 'Moeda não localizado');

             }
         }
    }

    public function imprimirmoeda()
    {
//        dd('Imprimir cotacão!');

        try {

            $response = Http::get("https://economia.awesomeapi.com.br/json/daily/USD-BRL/15")->json();
            $collection = collect($response);
            $colecao = $collection;

            $pdf = PDF::loadView('Projetos.Cotacao.pdfmoeda',
                [
                    'moeda_c_m' => $colecao,
                ]);

            return $pdf->download('pdf_file.pdf');


        } catch (\Throwable $exception) {

            return redirect()->back()->with('erro', 'Moeda não gerou pdf');

        }

    }

}
