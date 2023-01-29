<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotosController;
use App\Http\Controllers\LoginController;
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
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('', [DashboardController::class, 'index'])->name('index');
        Route::get('semanal', [DashboardController::class, 'semanal'])->name('semanal');
    });
    Route::prefix('fotos')->name('fotos.')->group(function() {
        Route::get('', [FotosController::class, 'index'])->name('index');
        Route::get('baixar/{arquivo}', [FotosController::class, 'baixar'])->name('baixar');
    });
});

Route::fallback(fn() => view('paginaInexistente'));