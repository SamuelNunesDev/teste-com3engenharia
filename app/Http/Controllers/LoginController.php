<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAutenticarRequest;
use App\Http\Requests\LoginSalvarUsuarioRequest;
use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Acesso a tela de login.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Faz a autenticação do usuário.
     * 
     * @param \App\Http\Requests\LoginAutenticarRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function autenticar(LoginAutenticarRequest $request)
    {
        try {
            if(Auth::attempt($request->only('email', 'password'))) {
                return redirect('dashboard')->with('sucesso', 'Login efetuado com sucesso.');
            }
            return back()->with('erro', 'Usuário ou senha incorretos.');
        } catch(Exception $e) {
            return back()->with('erro', 'Houve um erro ao tentar autenticar o usuário, contate o administrador do sistema. Erro: '.$e->getMessage());
        }
    }

    /**
     * Cadastra um novo usuário e efetua o login.
     * 
     * @param \App\Http\Requests\LoginSalvarUsuarioRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvarUsuario(LoginSalvarUsuarioRequest $request)
    {
        try {
            $dados = $request->only('nome', 'email', 'password');
            $dados['password'] = Hash::make($dados['password']);
            Usuario::create($dados);
            Auth::attempt($request->only('email', 'password'));

            return redirect('dashboard')->with('sucesso', 'Usuário cadastrado com sucesso. Você está logado.');; 
        } catch(Exception$e) {
            return back()->with('erro', 'Houve um erro ao tentar criar o usuário, contate o administrador do sistema. Erro: '.$e->getMessage());
        }
    }

    /**
     * Faz o logout do usuário.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect('login')->with('sucesso', 'Logout efetuado com sucesso.');
    }
}
