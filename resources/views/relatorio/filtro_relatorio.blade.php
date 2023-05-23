@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Filtro</h1>
            <p>Relatório Detalhado</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Relatórios</li>
            <li class="breadcrumb-item"><a href="#">Relatório Detalhado</a></li>
        </ul>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-9" style="display: inline-block; margin: auto;">
            <div class="tile">
                <h3 class="tile-title">Filtro</h3>
                <div class="tile-body">
                    <form method="POST" name="formusuario" action="{{ route('filtrarRelatorioDetalhado.filtrar') }}" class="form-horizontal">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="input-group-addon">Data Inicial*</span>
                                    <input id="datainicio" name="datainicio" placeholder="" class="form-control input-md"
                                        required type="date">
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-addon">Data Fim*</span>
                                    <input id="datafim" name="datafim" placeholder="" class="form-control input-md"
                                        required type="date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <Label class="form-check-label">Centro de Custo*</Label>
                                    <select class="form-control" id="centrocusto_id" name="centrocusto_id" required>
                                        <option disabled selected style="font-size:18px;color: black;" >Escolha
                                        </option>
                                        @foreach ($centrocustos as $centrocusto)
                                            <option value="{{$centrocusto->nome}}">{{$centrocusto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <Label class="form-check-label">Status</Label>
                                    <select class="form-control" id="status" name="status">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option value="Em Aberto">Em Aberto</option>
                                        <option value="Reembolsada">Reembolsada</option>
                                        <option value="Glosada">Glosada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <Label class="form-check-label">Tipo de Movimento</Label>
                                    <select class="form-control" id="movimento" name="movimento">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option value="Entrada">Entrada</option>
                                        <option value="Saida">Saída</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <Label class="form-check-label">Cartão Corporativo</Label>
                                    <select class="form-control" id="corporativo" name="corporativo">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <Label class="form-check-label">Responsavel</Label>
                                    <select class="form-control" id="usuario_id" name="usuario_id">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button id="Gerar" data-toggle="modal" data-target="#exampleModal"
                                        name="Gerar" class="btn btn-success" type="Submit">Gerar Relatório</button>
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
