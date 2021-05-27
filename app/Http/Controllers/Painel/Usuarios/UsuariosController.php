<?php

namespace App\Http\Controllers\Painel\Usuarios;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UsuariosController extends Controller
{

    public $request;
    public $usuarios;

    public function __construct(Request $request, User $usuarios)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
    }

    public function index()
    {
//        dd('teste index usuarios');
//        return view('Painel.Usuarios.index');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();
//            dd($this->request->route()->uri());

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $usuarios = $this->usuarios->all();
//            $usuarios = User::where('id','!-', 0);

            return view('Painel.Usuarios.index', compact('user','urlAtual','usuarios'));
        }

        return redirect()->route('admin.login');
    }
    public function create()
    {
//       dd('teste na funcçao create');

        if (Auth::check()) {

            $user = Auth::check();

            $uri = $this->request->route()->uri();

            $exploder = explode('/',$uri);

            $urlAtual = $exploder[1];

            $usuarios = $this->usuarios->all();

            return view('Painel.Usuarios.create', compact('user','urlAtual','usuarios'));
        }

        return redirect()->route('admin.login');

    }


    public function store(Request $request)
    {

        $email = User::where('email', $request->input('email'))->first();

        if (!$email) {

            User::create([

                'name' => $request->input('name'),
                'email' => $request->input('email'),
//                'password' => bcrypt($request->input('password')),
               'password' => Hash::make($request['password']),
                ]

            );

            return redirect()->route('Painel.Usuarios')->with('success', 'Usuário cadastrado com sucesso!');

        }

        return redirect()->back()->with('error', 'Houve um erro ao cadastrar usuário!');

    }

    public function show($id)
    {
        //
    }

    public function edit(
        int $id)
    {

        $usuarios = User::where('id',$id)->first();

//        dd($usuarios);

        if ($usuarios){

            if (Auth::check()) {

                $user = Auth::check();

                $uri = $this->request->route()->uri();


                $exploder = explode('/',$uri);

                $urlAtual = $exploder[1];
//                dd($urlAtual);
//                return view('Painel.Usuarios.edit', compact('user','urlAtual'));

                return view('Painel.Usuarios.edit', compact('user','urlAtual'))->with(
                    [
                        'registro' => $usuarios->id,
                        'name' => $usuarios->name,
                        'email' => $usuarios->email,
                        'password' => $usuarios->password,
                    ]
                );
            }
        }
    }


    public function update(
        int $id,
        Request $request
    )

    {

//        dd($request);
        $usuarios = User::where('id',$id)->first();

        if ($usuarios) {

            User::whereId($request->id)->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request['password']),
                ]
            );

            return redirect('Painel/Usuarios')->withSucesso('Usuiário atualizado com sucesso!!');
        }

        return redirect('Painel/Usuarios')->withSucesso('Usuário nâo atualizado !!');

    }

    public function delete(
        int $id
    )
    {
        $usuario = User::where('id',$id)->first();

        if ($usuario) {
            $usuario->delete();
            return redirect('Painel/Usuarios')->withSucesso('Usuiário deletado com sucesso!!');
        }

        return redirect('Painel/Usuarios')->withSucesso('Usuiário não deletado com sucesso!!');

    }

}
