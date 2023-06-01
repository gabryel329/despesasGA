<?php

use App\Http\Controllers\BuscarAdministrativaController;
use App\Http\Controllers\BuscarCartaoController;
use App\Http\Controllers\BuscarCentroCustoController;
use App\Http\Controllers\BuscarGastosController;
use App\Http\Controllers\BuscarContaController;
use App\Http\Controllers\BuscarReembolsoController;
use App\Http\Controllers\BuscarUsuarioController;
use App\Http\Controllers\CartaoController;
use App\Http\Controllers\CentroCustoController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\GraficosRelatoriosController;
use App\Http\Controllers\PDFController;
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

#ROTA TIPOS DE CARTÃO
Route::get('/cartaos', [CartaoController::class, 'index'])->name('cartaos.index');
Route::post('/cartaos', [CartaoController::class, 'store'])->name('cartaos.store');

#ROTA REEMBOLSO
Route::get('/reembolso', [ReembolsoController::class, 'index'])->name('reembolso.index');
Route::post('/reembolso', [ReembolsoController::class, 'store'])->name('reembolso.store');

#ROTA BUSCAR CENTRO CUSTO
Route::get('/Buscar/buscarCentroCusto', [BuscarCentroCustoController::class, 'index'])->name('buscarcentrocusto.index');
Route::delete('/Buscar/deletarCentroCusto/{id}',[BuscarCentroCustoController::class, 'destroy'])->name('buscarcentrocusto.destroy');
Route::post('/Buscar/pesquisarCentroCusto', [BuscarCentroCustoController::class, 'search'])->name('pesquisarcentrocusto.search');
Route::get('/Buscar/mostrarCentroCusto/{id}', [BuscarCentroCustoController::class, 'show'])->name('mostrarcentrocusto.show');
Route::get('/Buscar/editarCentroCusto/{id}',[BuscarCentroCustoController::class, 'edit'])->name('editarcentrocusto.edit');
Route::put('/Buscar/atualizarCentroCusto/{id}',[BuscarCentroCustoController::class, 'update'])->name('atualizarcentrocusto.update');

#ROTA BUSCAR GASTOS
Route::get('/Buscar/buscarGastos', [BuscarGastosController::class, 'index'])->name('buscargastos.index')->middleware('admin');
Route::delete('/Buscar/deletarGastos/{id}',[BuscarGastosController::class, 'destroy'])->name('buscargastos.destroy');
Route::post('/Buscar/pesquisarGastos', [BuscarGastosController::class, 'search'])->name('pesquisargastos.search');
Route::get('/Buscar/mostrarGastos/{id}', [BuscarGastosController::class, 'show'])->name('mostrargastos.show');
Route::get('/Buscar/editarGastos/{id}',[BuscarGastosController::class, 'edit'])->name('editargastos.edit');
Route::put('/Buscar/atualizarGastos/{id}',[BuscarGastosController::class, 'update'])->name('atualizargastos.update');

#ROTA BUSCAR CARTAO
Route::get('/Buscar/buscarCartaos', [BuscarCartaoController::class, 'index'])->name('buscarcartaos.index')->middleware('admin');
Route::delete('/Buscar/deletarCartaos/{id}',[BuscarCartaoController::class, 'destroy'])->name('buscarcartaos.destroy');
Route::post('/Buscar/pesquisarCartaos', [BuscarCartaoController::class, 'search'])->name('pesquisarcartaos.search');
Route::get('/Buscar/mostrarCartaos/{id}', [BuscarCartaoController::class, 'show'])->name('mostrarcartaos.show');
Route::get('/Buscar/editarCartaos/{id}',[BuscarCartaoController::class, 'edit'])->name('editarcartaos.edit');
Route::put('/Buscar/atualizarCartaos/{id}',[BuscarCartaoController::class, 'update'])->name('atualizarcartaos.update');

#ROTA BUSCAR REEMBOLSO
Route::get('/Buscar/buscarReembolsos', [BuscarReembolsoController::class, 'index'])->name('buscarreembolsos.index');
Route::delete('/Buscar/deletarReembolsos/{id}',[BuscarReembolsoController::class, 'destroy'])->name('buscarreembolsos.destroy')->middleware('admin');
Route::post('/Buscar/pesquisarReembolsos', [BuscarReembolsoController::class, 'search'])->name('pesquisarreembolsos.search');
Route::get('/Buscar/mostrarReembolsos/{id}', [BuscarReembolsoController::class, 'show'])->name('mostrarreembolsos.show');
Route::get('/Buscar/editarReembolsos/{id}',[BuscarReembolsoController::class, 'edit'])->name('editarreembolsos.edit')->middleware('admin');
Route::put('/Buscar/atualizarReembolsos/{id}',[BuscarReembolsoController::class, 'update'])->name('atualizarreembolsos.update')->middleware('admin');

#ROTA BUSCAR REEMBOLSO
Route::get('/Buscar/buscarUsuarios', [BuscarUsuarioController::class, 'index'])->name('buscarusuarios.index')->middleware('admin');
Route::delete('/Buscar/deletarUsuarios/{id}',[BuscarUsuarioController::class, 'destroy'])->name('buscarusuarios.destroy');
Route::post('/Buscar/pesquisarUsuarios', [BuscarUsuarioController::class, 'search'])->name('pesquisarusuarios.search');
Route::get('/Buscar/mostrarUsuarios/{id}', [BuscarUsuarioController::class, 'show'])->name('mostrarusuarios.show');
Route::get('/Buscar/editarUsuarios/{id}',[BuscarUsuarioController::class, 'edit'])->name('editarusuarios.edit');
Route::put('/Buscar/atualizarUsuarios/{id}',[BuscarUsuarioController::class, 'update'])->name('atualizarusuarios.update');

#ROTA BUSCAR ADMINISTRATIVA
Route::get('/Buscar/buscarAdministrativa', [BuscarAdministrativaController::class, 'index'])->name('buscaradministrativo.index')->middleware('admin');

#ROTA GRAFICOS TELA INICIAL
Route::get('/home', [GraficosRelatoriosController::class, 'index'])->name('graficosrelatorios.index');

#ROTA RELATORIOS DETALHADOS
Route::get('/Relatorio/relatorioDetalhado', [GraficosRelatoriosController::class, 'filtroRelatorio'])->name('relatorioDetalhado.filtroRelatorio');
Route::post('/Relatorio/filtrarRelatorioDetalhado', [GraficosRelatoriosController::class, 'filtrar'])->name('filtrarRelatorioDetalhado.filtrar');
Route::get('/Relatorio/listaRelatorioDetalhado', [GraficosRelatoriosController::class, 'lista'])->name('listaRelatorioDetalhado.lista');

#ROTA GRAFICOS ADMINISTRATIVO
Route::get('/Administrativo/graficosAdministrativo', [GraficosRelatoriosController::class, 'graficosADM'])->name('graficos.graficosADM')->middleware('admin');

#ROTA GERAR PDF
Route::get('/Relatorio/PDF', [GraficosRelatoriosController::class, 'gerarPDF'])->name('gerar.pdf');
