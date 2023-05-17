@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Cadastro</h1>
            <p>Tipos de Gastos</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Cadastros</li>
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
                    <form method="POST" name="formusuario" action="{{ route('gastos.store') }}" class="form-horizontal">
                        @csrf
                        <div class="col-md-11 control-label">
                            <p class="help-block">
                                <h11>*</h11> Campo Obrigatório
                            </p>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input-group-addon">Nome <h11>*</h11> <p style="font-size: smaller;">(Apenas letras MAIUSCULAS)</p></span>
                                    <input id="nome" name="nome" placeholder="" class="form-control input-md"
                                    pattern="^[A-Z]+$" required type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observação</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button id="Cadastrar" data-toggle="modal" data-target="#exampleModal"
                                        name="Cadastrar" class="btn btn-success" type="Submit">Cadastrar</button>
                                    <button id="cancelar" name="cancelar" class="btn btn-danger"
                                        type="Reset">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
