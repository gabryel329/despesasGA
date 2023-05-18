<?php

use App\Http\Controllers\BuscarCentroCustoController;
use App\Http\Controllers\BuscarGastosController;
use App\Http\Controllers\BuscarReembolsoController;
use App\Http\Controllers\BuscarUsuarioController;
use App\Http\Controllers\CentroCustoController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\ReembolsoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


#ROTA CENTROCUSTO
Route::get('/centrocusto', [CentroCustoController::class, 'index'])->name('centrocusto.index');
Route::post('/centrocusto', [CentroCustoController::class, 'store'])->name('centrocusto.store');

#ROTA USUARIO
Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index');
Route::post('/usuario', [UsuarioController::class, 'store'])->name('usuario.store');

#ROTA TIPOS DE GASTOS
Route::get('/gastos', [GastosController::class, 'index'])->name('gastos.index');
Route::post('/gastos', [GastosController::class, 'store'])->name('gastos.store');

#ROTA REEMBOLSO
Route::get('/reembolso', [ReembolsoController::class, 'index'])->name('reembolso.index');
Route::post('/reembolso', [ReembolsoController::class, 'store'])->name('reembolso.store');

#ROTA BUSCAR CENTRO CUSTO
Route::get('/Buscar/buscarCentroCusto', [BuscarCentroCustoController::class, 'index'])->name('buscarcentrocusto.index');
Route::delete('/Buscar/deletarCentroCusto/{id}',[BuscarCentroCustoController::class, 'destroy'])->name('buscarcentrocusto.destroy');
Route::post('/Buscar/pesquisarCentroCusto', [BuscarCentroCustoController::class, 'search'])->name('pesquisarcentrocusto.search');
Route::get('/Buscar/mostrarCentroCusto/{id}', [BuscarCentroCustoController::class, 'show'])->name('mostrarcentrocusto.show');
Route::get('/Buscar/editarCentroCusto/{id}',[BuscarCentroCustoController::class, 'edit'])->name('editarcentrocusto.edit');
Route::put('/Buscar/{id}',[BuscarCentroCustoController::class, 'update'])->name('atualizarcentrocusto.update');

#ROTA BUSCAR GASTOS
Route::get('/Buscar/buscarGastos', [BuscarGastosController::class, 'index'])->name('buscargastos.index');
Route::delete('/Buscar/deletarGastos/{id}',[BuscarGastosController::class, 'destroy'])->name('buscargastos.destroy');
Route::post('/Buscar/pesquisarGastos', [BuscarGastosController::class, 'search'])->name('pesquisargastos.search');
Route::get('/Buscar/mostrarGastos/{id}', [BuscarGastosController::class, 'show'])->name('mostrargastos.show');
Route::get('/Buscar/editarGastos/{id}',[BuscarGastosController::class, 'edit'])->name('editargastos.edit');
Route::put('/Buscar/{id}',[BuscarGastosController::class, 'update'])->name('atualizargastos.update');

#ROTA BUSCAR REEMBOLSO
Route::get('/Buscar/buscarReembolsos', [BuscarReembolsoController::class, 'index'])->name('buscarreembolsos.index');
Route::delete('/Buscar/deletarReembolsos/{id}',[BuscarReembolsoController::class, 'destroy'])->name('buscarreembolsos.destroy');
Route::post('/Buscar/pesquisarReembolsos', [BuscarReembolsoController::class, 'search'])->name('pesquisarreembolsos.search');
Route::get('/Buscar/mostrarReembolsos/{id}', [BuscarReembolsoController::class, 'show'])->name('mostrarreembolsos.show');
Route::get('/Buscar/editarReembolsos/{id}',[BuscarReembolsoController::class, 'edit'])->name('editarreembolsos.edit');
Route::put('/Buscar/{id}',[BuscarReembolsoController::class, 'update'])->name('atualizarreembolsos.update');

#ROTA BUSCAR REEMBOLSO
Route::get('/Buscar/buscarUsuarios', [BuscarUsuarioController::class, 'index'])->name('buscarusuarios.index');
Route::delete('/Buscar/deletarUsuarios/{id}',[BuscarUsuarioController::class, 'destroy'])->name('buscarusuarios.destroy');
Route::post('/Buscar/pesquisarUsuarios', [BuscarUsuarioController::class, 'search'])->name('pesquisarusuarios.search');
Route::get('/Buscar/mostrarUsuarios/{id}', [BuscarUsuarioController::class, 'show'])->name('mostrarusuarios.show');
Route::get('/Buscar/editarUsuarios/{id}',[BuscarUsuarioController::class, 'edit'])->name('editarusuarios.edit');
Route::put('/Buscar/{id}',[BuscarUsuarioController::class, 'update'])->name('atualizarusuarios.update');
