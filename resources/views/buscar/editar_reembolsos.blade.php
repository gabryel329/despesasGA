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
                    <form action="{{ route('atualizarreembolsos.update', ['id'=>$reembolsos->id]) }}" method="POST" >
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
                                         type="text" onblur="formatarValor(this)" value="{{$reembolsos->valor}}">
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
                                    <select class="form-control" id="gasto_id" name="gasto_id">
                                        <option selected >{{$reembolsos->gasto_id}}
                                        </option>
                                        @foreach ($gastos as $gasto)
                                            <option value="{{$gasto->nome}}">{{$gasto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <Label class="form-check-label">Responsavel<h11>*</h11></Label>
                                    <select class="form-control" id="usuario_id" name="usuario_id">
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
                                    <select class="form-control" id="centrocusto_id" name="centrocusto_id">
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
                                    <select class="form-control" id="tipo" name="tipo">
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
                                <div class="col-md-4">
                                    <Label class="form-check-label">Tipo de Movimento<h11>*</h11></Label>
                                    <select class="form-control" id="movimento" name="movimento">
                                        <option  selected style="font-size:18px;color: black;" value="{{$reembolsos->movimento}}">{{$reembolsos->movimento}}
                                        </option>
                                        <option value="Entrada">Entrada</option>
                                        <option value="Saida">Saida</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <Label class="form-check-label">Cartão Corporativo<h11>*</h11></Label>
                                    <select class="form-control" id="corporativo" name="corporativo">
                                        <option selected >{{$reembolsos->corporativo}}
                                        </option>
                                        <option value="Sim">Sim</option>
                                        <option value="Nao">Nao</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6" id="forma_pagamento2">
                                    <label class="control-label">Forma de Pagamento<h11>*</h11></label>
                                    <select onchange="adicionarcampo3(this.value)" class="form-control" id="" name="forma_pgt" >
                                        <option selected >{{$reembolsos->forma_pgt}}
                                        </option>
                                        <option>Pix</option>
                                        <option>Dinheiro</option>
                                        <option>Debito</option>
                                        <option value="Credito">Credito</option>
                                    </select>
                                </div>
                                <div class="col-md-6" id="parcelas3" hidden>
                                    <label class="control-label">Parcelas<h11>*</h11></label>
                                    <select class="form-control" id="" name="parcelas" >
                                        <option selected>{{$reembolsos->parcelas}}
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
