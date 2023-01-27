<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function() {
    Route::get('', fn() =>  redirect('login'));
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'autenticar'])->name('autenticar');
    Route::get('cadastrar-usuario', [LoginController::class, 'login'])->name('cadastro.usuario');
    Route::post('cadastrar-usuario', [LoginController::class, 'salvarUsuario'])->name('salvar.usuario');
});

Route::middleware('auth')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('logout', fn() => Auth::logout());
});

Route::fallback(fn() => view('paginaInexistente'));