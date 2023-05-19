@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Cadastro</h1>
            <p>Centro de Custo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Cadastros</li>
            <li class="breadcrumb-item"><a href="#">Centro de Custo</a></li>
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
                    <form method="POST" name="formusuario" action="{{ route('centrocusto.store') }}" class="form-horizontal">
                        @csrf
                        <div class="col-md-11 control-label">
                            <p class="help-block">
                                <h11>*</h11> Campo Obrigatório
                            </p>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input-group-addon">Nome <h11>*</h11></span>
                                    <input id="nome" name="nome" placeholder="" class="form-control input-md"
                                    required type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="input-group-addon">Cidade<h11>*</h11></span>
                                    <input class="form-control" name="cidade" type="text"
                                            id="cidade" size="40" /></label>
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-addon">Estado<h11>*</h11></span>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="">Selecione um estado</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
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
