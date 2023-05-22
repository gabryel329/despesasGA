@extends('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Detalhes</h1>
            <p>Reembolso</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Detalhes</li>
            <li class="breadcrumb-item"><a href="#">Reembolso</a></li>
        </ul>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('alert-warning'))
        <div class="alert alert-warning">
            {{ session('alert-warning') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-9" style="display: inline-block; margin: auto;">
            <div class="tile">
                <h3 class="tile-title">Reembolso</h3>
                <div class="tile-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="input-group-addon" for="valor"><h6>Valor</h6></span>
                                    <input id="valor" name="valor" placeholder="" class="form-control input-md"
                                        required="" type="text" required onblur="formatarValor(this)" value="{{ $reembolsos->valor }}" disabled style="font-size:18px;color: black;">
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-addon"><h6>Data</h6></span>
                                    <input id="data" name="data" placeholder="" class="form-control input-md"
                                        required="" type="date" value="{{ $reembolsos->data }}" disabled style="font-size:18px;color: black;">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="form-check-label">Nutureza Operação</h6>
                                    <input class="form-control" id="gasto_id" name="gasto_id" value="{{ $reembolsos->gasto_id }}" disabled style="font-size:18px;color: black;">

                                </div>
                                <div class="col-md-6">
                                    <h6 class="form-check-label">Responsavel</h6>
                                    <input class="form-control" id="usuario_id" name="usuario_id" value="{{ $reembolsos->usuario_id }}" disabled style="font-size:18px;color: black;">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="form-check-label">Centro de Custo</h6>
                                    <input class="form-control" id="centrocusto_id" name="centrocusto_id" value="{{ $reembolsos->centrocusto_id }}" disabled style="font-size:18px;color: black;">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="form-check-label">Tipo</h6>
                                    <input class="form-control" id="tipo" name="tipo" value="{{ $reembolsos->tipo }}" disabled style="font-size:18px;color: black;">
                                </div>
                                <div class="col-md-4">
                                    <h6 class="form-check-label">Status</h6>
                                    <input class="form-control" id="status" name="status" value="{{ $reembolsos->status }}" disabled style="font-size:18px;color: black;">
                                </div>
                                <div class="col-md-4">
                                    <h6 class="form-check-label">Cartão Corporativo</h6>
                                    <input class="form-control" id="corporativo" name="corporativo" value="{{ $reembolsos->corporativo }}" disabled style="font-size:18px;color: black;">
                                </div>
                            </div>
                            {{-- <br>
                            <div class="row">
                                <div class="col-md-6" id="forma_pagamento2">
                                    <h6 class="control-label">Forma de Pagamento</h6>
                                    <input onchange="adicionarcampo3(this.value)" class="form-control" id="forma_pgt" name="forma_pgt" required value="{{ $reembolsos->forma_pgt }}">
                                </div>
                                <div class="col-md-6" id="parcelas3">
                                    <h6 class="control-label">Parcelas</h6>
                                    <input class="form-control" id="parcelas" name="parcelas" required value="{{ $reembolsos->parcelas }}">
                                </div>
                            </div> --}}
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 >Comprovante</h6>
                                        <button type="button" class="btn btn-md" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            <a>Visualizar<i class="app-menu__icon fa fa-eye" aria-hidden="true"></i></a>
                                        </button>
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Comprovante</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <img src="/img/arquivos/{{ $reembolsos->image }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 for="exampleFormControlTextarea1">Observação</h6>
                                    <input class="form-control" id="observacao" name="observacao" rows="3"value="{{ $reembolsos->observacao }}" disabled style="font-size:18px;color: black;">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <a class="btn btn-success" type="button" href="{{ route('editarreembolsos.edit', $reembolsos->id) }}" >Editar</a>
                                </div>
                            </div>
                        </div>
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
