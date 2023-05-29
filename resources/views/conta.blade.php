@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Cadastro</h1>
            <p>Conta</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Cadastros</li>
            <li class="breadcrumb-item"><a href="#">Conta</a></li>
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
                <h3 class="tile-title">Conta</h3>
                <div class="tile-body">
                    <form method="POST" name="formusuario" action="{{ route('conta.store') }}" class="form-horizontal">
                        @csrf
                        <div class="col-md-11 control-label">
                            <p class="help-block">
                                <h11>*</h11> Campo Obrigatório
                            </p>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input-group-addon">Nome ou Número<h11>*</h11></span>
                                    <input id="nome" name="nome" placeholder="" class="form-control input-md"
                                    required type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-check-label">Centro de Custo<h11>*</h11></label>
                                    <select class="form-control select2" id="centrocusto_id" name="centrocusto_id" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                        @foreach ($centrocustos as $centrocusto)
                                            <option value="{{$centrocusto->nome}}">{{$centrocusto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <Label class="form-check-label">Tipo<h11>*</h11></Label>
                                    <select class="form-control select2" id="tipo" name="tipo">
                                        <option disabled selected style="font-size:18px;color: black;" required>Escolha
                                        </option>
                                        <option value="Implantação">Implantação</option>
                                        <option value="Treinamento">Treinamento</option>
                                        <option value="Visita">Visita</option>
                                        <option value="Suporte">Suporte</option>
                                        <option value="Apresentação do Sistema">Apresentacão do Sistema</option>
                                        <option value="Reunião">Reunião</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observação</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
                            </div>
                            <br>
                            <div class="row">
                            <div class="col-md-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Gravar">
                                    <a class="btn btn-danger" type="button" href="{{ route('buscarconta.index') }}">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
