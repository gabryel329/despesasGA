@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Cadastro</h1>
            <p>Reembolso</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Cadastros</li>
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
                    <form method="POST" name="formusuario" action="{{ route('reembolso.store') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
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
                                        required="" type="text" required onblur="formatarValor(this)">
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-addon">Data <h11>*</h11></span>
                                    <input id="data" name="data" placeholder="" class="form-control input-md"
                                        required="" type="date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <Label class="form-check-label">Tipo de Gasto<h11>*</h11></Label>
                                    <select class="form-control" id="gasto_id" name="gasto_id">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        {{-- <option>Aberta</option>
                                        <option>Quitada</option> --}}
                                        @foreach ($gastos as $gasto)
                                            <option value="{{$gasto->nome}}">{{$gasto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="col-md-6">
                                    <Label class="form-check-label">Responsavel<h11>*</h11></Label>
                                    <select class="form-control" id="usuario_id" name="usuario_id">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option> --}}
                                        {{-- <option>Aberta</option>
                                        <option>Quitada</option> --}}
                                        {{-- @foreach ($usuarios as $usuario)
                                            <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                                        @endforeach --}}
                                    {{-- </select> --}}
                                {{-- </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <Label class="form-check-label">Centro de Custo<h11>*</h11></Label>
                                    <select class="form-control" id="centrocusto_id" name="centrocusto_id">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
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
                                    <select class="form-control" id="tipo" name="tipo">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option value="Implantacão">Implantacão</option>
                                        <option value="Treinamento">Treinamento</option>
                                        <option value="Visita">Visita</option>
                                        <option value="Suporte">Suporte</option>
                                        <option value="Apresentacão do Sistema">Apresentacão do Sistema</option>
                                        <option value="Reunião">Reunião</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <Label class="form-check-label">Status<h11>*</h11></Label>
                                    <select class="form-control" id="status" name="status">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option value="Em Aberto">Em Aberto</option>
                                        <option value="Reembolsada">Reembolsada</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <Label class="form-check-label">Cartão Corporativo<h11>*</h11></Label>
                                    <select class="form-control" id="corporativo" name="corporativo">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6" id="forma_pagamento2">
                                    <label class="control-label">Forma de Pagamento<h11>*</h11></label>
                                    <select onchange="adicionarcampo3(this.value)" class="form-control" id="forma_pgt" name="forma_pgt" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option>Pix</option>
                                        <option>Dinheiro</option>
                                        <option>Debito</option>
                                        <option value="Credito">Credito</option>
                                    </select>
                                </div>
                                <div class="col-md-6" id="parcelas3" hidden>
                                    <label class="control-label">Parcelas<h11>*</h11></label>
                                    <select class="form-control" id="parcelas" name="parcelas" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option>A vista</option>
                                        <option>x2</option>
                                        <option>x3</option>
                                        <option>x4</option>
                                        <option>x5</option>
                                        <option>x6</option>
                                        <option>x7</option>
                                        <option>x8</option>
                                        <option>x9</option>
                                        <option>x10</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <Label class="form-check-label">Comprovante<h11>*</h11></Label>
                                    <input class="form-control" type="file" name="image">
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

@push('scripts')
<script>
function formatarValor(campo) {
    const valor = parseFloat(campo.value.replace(',', '.')).toFixed(2);
    const valor_formatado = valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    campo.value = valor_formatado;
  }
</script>

<script>

    function adicionarcampo3(e) {
        var parcelas = document.getElementById('parcelas3')

        if (e == "Credito") {
            parcelas.removeAttribute("hidden");
        } else if (e != 'Credito') {
            parcelas.setAttribute("hidden", true);
        }
    }

</script>
@endpush
