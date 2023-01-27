<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAutenticarRequest;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::attempt($request->only('email', 'senha'))) {
            return redirect('dashboard');
        }
        return back()->with('erro', 'Usuário ou senha incorretos.');
    }
}
