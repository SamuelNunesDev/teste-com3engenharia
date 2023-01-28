<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Acesso a tela inicial do dashboard.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}