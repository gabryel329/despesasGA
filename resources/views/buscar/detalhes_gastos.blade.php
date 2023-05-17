@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Detalhes</h1>
            <p>Tipos de Gastos</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Buscar</li>
            <li class="breadcrumb-item"><a href="#">Tipos de Gastos</a></li>
        </ul>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6" style="display: inline-block; margin: auto;">
            <div class="tile">
                <h3 class="tile-title">Tipos de Gastos</h3>
                <div class="tile-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input-group-addon">Nome<p style="font-size: smaller;">(Apenas letras MAIUSCULAS)</p></span>
                                    <input id="nome" name="nome" placeholder="" class="form-control input-md"
                                    pattern="^[A-Z]+$" required type="text" value="{{ $gastos->nome }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observação</label>
                                <input class="form-control" id="observacao" name="observacao" rows="3" value="{{ $gastos->observacao }}">
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <a class="btn btn-success" type="button" href="{{ route('editargastos.edit', $gastos->id) }}">Editar</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>
