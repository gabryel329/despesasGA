@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Editar</h1>
            <p>Reembolso</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item"><a href="#">Reembolso</a></li>
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
                <h3 class="tile-title">Reembolso</h3>
                <div class="tile-body">
                    <form action="{{ route('atualizarreembolsos.update', ['id'=>$reembolsos->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="col-md-11 control-label">
                            <p class="help-block">
                                <h11>*</h11> Campo Obrigatório
                            </p>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="input-group-addon" for="valor">Valor <h11>*</h11></span>
                                    <input id="valor" name="valor" placeholder="" class="form-control input-md"
                                         type="text" onKeyPress="return(moeda(this,'.',',',event))" value="{{$reembolsos->valor}}">
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-addon">Data <h11>*</h11></span>
                                    <input id="data" name="data" placeholder="" class="form-control input-md"
                                         type="date" value="{{$reembolsos->data}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <Label class="form-check-label">Nutureza Operação<h11>*</h11></Label>
                                    <select class="form-control select2" id="gasto_id" name="gasto_id">
                                        <option selected >{{$reembolsos->gasto_id}}
                                        </option>
                                        @foreach ($gastos as $gasto)
                                            <option value="{{$gasto->nome}}">{{$gasto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <Label class="form-check-label">Responsavel<h11>*</h11></Label>
                                    <select class="form-control select2" id="usuario_id" name="usuario_id">
                                        <option selected>{{$reembolsos->usuario_id}}
                                        </option>
                                        {{-- <option>Aberta</option>
                                        <option>Quitada</option> --}}
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <Label class="form-check-label">Centro de Custo<h11>*</h11></Label>
                                    <select class="form-control select2" id="centrocusto_id" name="centrocusto_id">
                                        <option selected>{{$reembolsos->centrocusto_id}}
                                        </option>
                                        @foreach ($centrocustos as $centrocusto)
                                            <option value="{{$centrocusto->nome}}">{{$centrocusto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <Label class="form-check-label">Tipo<h11>*</h11></Label>
                                    <select class="form-control select2" id="tipo" name="tipo">
                                        <option selected>{{$reembolsos->tipo}}
                                        </option>
                                        <option value="Implantacao">Implantação</option>
                                        <option value="Treinamento">Treinamento</option>
                                        <option value="Visita">Visita</option>
                                        <option value="Suporte">Suporte</option>
                                        <option value="Apresentacao do Sistema">Apresentação do Sistema</option>
                                        <option value="Reuniao">Reunião</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="parcelas3">
                                    <label class="form-check-label">Cartão Corporativo<h11>*</h11></label>
                                    <select onchange="atualizarCampos(this.value)" class="form-control" id="corporativo" name="corporativo" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Nao">Não</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <Label class="form-check-label">Tipo de Movimento<h11>*</h11></Label>
                                    <select class="form-control" id="movimento" onchange="adicionarcampo4(this.value)" name="movimento">
                                        <option  selected style="font-size:18px;color: black;" value="{{$reembolsos->movimento}}">{{$reembolsos->movimento}}
                                        </option>
                                        <option value="Entrada">Entrada</option>
                                        <option value="Saida">Saida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-6" id="forma_pagamento2">
                                    <label class="control-label">Forma de Pagamento<h11>*</h11></label>
                                    <select onchange="adicionarcampo4(this.value)" class="form-control" id="" name="forma_pgt" >
                                        <option selected >{{$reembolsos->forma_pgt}}
                                        </option>
                                        <option>Pix</option>
                                        <option>Dinheiro</option>
                                        <option>Debito</option>
                                        <option value="Credito">Credito</option>
                                    </select>
                                </div> --}}
                                <div class="col-md-6" id="parcelas4" hidden>
                                    <label class="control-label">Qual cartão:<h11>*</h11></label>
                                    <select class="form-control" id="cartao_id" name="cartao_id">
                                        <option selected>{{$reembolsos->cartao_id}}
                                        @foreach ($cartaos as $cartao)
                                            <option value="{{$cartao->nome}}">{{$cartao->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <Label class="form-check-label">Comprovante<h11>*</h11></Label>
                                    <input class="form-control" type="file" name="image">
                                </div>
                                <div class="col-md-6">
                                    <Label class="form-check-label">Status<h11>*</h11></Label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option  value="{{$reembolsos->status}}" style="font-size:18px;color: black;">{{$reembolsos->status}}
                                        </option>
                                        <option value="Em Aberto">Em Aberto</option>
                                        <option value="Reembolsada">Reembolsada</option>
                                        <option value="Glosada">Glosada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observação</label>
                                <input class="form-control" id="observacao" name="observacao" rows="3" value="{{$reembolsos->observacao}}">
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="submit" name="submit" class="btn btn-success" value="Atualizar">
                                    <a class="btn btn-danger" type="button" href="{{ route('mostrarreembolsos.show', $reembolsos->id) }}">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')

@endpush
