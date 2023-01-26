<?php

namespace App\Http\Controllers;

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
}
