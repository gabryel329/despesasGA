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
            <li class="breadcrumb-item"><a href="#">Lançamento</a></li>
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
                <h3 class="tile-title">Lançamento</h3>
                <div class="tile-body">
                    <form method="POST" name="formlancamento" id="formlancamento"  action="{{ route('reembolso.store') }}" class="form-horizontal" enctype="multipart/form-data">
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
                                    <input id="valor" name="valor" placeholder="" class="form-control input-md" type="text" onKeyPress="return(moeda(this,'.',',',event))" required>
                                  </div>
                                <div class="col-md-6">
                                    <span class="input-group-addon">Data <h11>*</h11></span>
                                    <input id="data" name="data" placeholder="" class="form-control input-md" type="date" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <Label class="input-group-addon">Nutureza Operação<h11>*</h11></Label>
                                    <select class="select2 form-control input-md" id="gasto_id" name="gasto_id" value="{{ old('gasto_id') }}" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        @foreach ($gastos as $gasto)
                                            <option value="{{$gasto->nome}}">{{$gasto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="input-group-addon">Centro de Custo<h11>*</h11></label>
                                    <select class="select2 form-control input-md" id="centrocusto_id" name="centrocusto_id" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                        @foreach ($centrocustos as $centrocusto)
                                            <option value="{{$centrocusto->nome}}">{{$centrocusto->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <Label class="input-group-addon">Tipo da Visita<h11>*</h11></Label>
                                    <select class="select2 form-control input-md" id="tipo" name="tipo" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        <option value="Implantação">Implantação</option>
                                        <option value="Treinamento">Treinamento</option>
                                        <option value="Visita">Visita</option>
                                        <option value="Suporte">Suporte</option>
                                        <option value="Apresentação do Sistema">Apresentacão do Sistema</option>
                                        <option value="Reunião">Reunião</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="parcelas3" >
                                    <label class="input-group-addon">Cartão Corporativo<h11>*</h11></label>
                                    <select onchange="atualizarCampos(this.value)" class="form-control input-md" id="corporativo" name="corporativo" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Nao">Não</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="input-group-addon">Tipo de Movimento<h11>*</h11></label>
                                    <select class="form-control input-md" id="movimento" name="movimento" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                        <option value="Saida">Saída</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" id="parcelas4" hidden>
                                    <label class="control-label">Qual cartão:<h11>*</h11></label>
                                    <select class="form-control input-md" id="cartao_id" name="cartao_id" required>
                                        <option disabled selected style="font-size:18px;color: black;">Escolha
                                        </option>
                                        @foreach ($cartaos as $cartao)
                                            <option value="{{$cartao->nome}}">{{$cartao->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <Label class="input-group-addon">Comprovante</Label>
                                    <input class="form-control input-md" type="file" name="image">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observação</label>
                                <textarea class="form-control input-md" id="observacao" name="observacao" rows="3"></textarea>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" name="button" onclick="validaformulario()" class="btn btn-success">Gravar</button>
                                    <a class="btn btn-danger" type="button" href="{{ route('buscarreembolsos.index') }}">Cancelar</a>
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
        function validaformulario()
        {

           if ((document.getElementById("gasto_id").value!='Escolha'))
           {
                if ((document.getElementById("centrocusto_id").value!='Escolha'))
                {
                    if ((document.getElementById("tipo").value!='Escolha'))
                    {
                        if ((document.getElementById("movimento").value!='Escolha'))
                            {
                            if ((document.getElementById("corporativo").value!='Escolha'))
                                {
                                document.getElementById("formlancamento").submit();
                                }else{
                                    Swal.fire({
                                            position: 'top',
                                            icon: 'error',
                                            title: 'Por favor preencher o Cartão Corporativo.',
                                            showConfirmButton: false,
                                            timer: 1500
                                            });
                            }
                        }else{
                            Swal.fire({
                                    position: 'top',
                                    icon: 'error',
                                    title: 'Por favor preencher o Tipo de Movimento.',
                                    showConfirmButton: false,
                                    timer: 1500
                                    });
                        }
                    }else{
                        Swal.fire({
                                position: 'top',
                                icon: 'error',
                                title: 'Por favor preencher o Tipo da Visita.',
                                showConfirmButton: false,
                                timer: 1500
                                });
                    }
                }else{
                    Swal.fire({
                            position: 'top',
                            icon: 'error',
                            title: 'Por favor preencher o Centro de Custo.',
                            showConfirmButton: false,
                            timer: 1500
                            });
                }
           }else{
                Swal.fire({
                            position: 'top',
                            icon: 'error',
                            title: 'Por favor preencher a Natureza de Operação.',
                            showConfirmButton: false,
                            timer: 1500
                            });
           }

        }
    </script>
@endpush
