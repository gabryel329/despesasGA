@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Detalhes</h1>
            <p>Centro de Custo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Buscar</li>
            <li class="breadcrumb-item"><a href="#">Detalhes</a></li>
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
                <h3 class="tile-title">Centro de Custo</h3>
                <div class="tile-body">
                    <form action="{{ route('atualizarcentrocusto.update', $centrocustos->id) }}" method="POST" >
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input-group-addon">Nome </span>
                                    <input id="nome" name="nome" placeholder="" class="form-control input-md"
                                     required type="text" value="{{ $centrocustos->nome }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="input-group-addon">Cidade</span>
                                    <input class="form-control" name="cidade" type="text"
                                            id="cidade" size="40" value="{{ $centrocustos->cidade }}">
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-addon">Estado</span>
                                    <input class="form-control" name="estado" type="text"
                                            id="estado" size="40" value="{{ $centrocustos->estado }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observação</label>
                                <input class="form-control" id="observacao" name="observacao" rows="3" value="{{ $centrocustos->observacao }}">
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="submit" name="submit" class="btn btn-success" value="Atualizar">
                                    <a class="btn btn-danger" type="button" href="{{ route('mostrarcentrocusto.show', $centrocustos->id) }}">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
