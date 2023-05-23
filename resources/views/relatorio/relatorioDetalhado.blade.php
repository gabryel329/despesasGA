@extends('layouts.app')

@section('content')
    <div class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Relatório Detalhado</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Relatório</li>
                <li class="breadcrumb-item"><a href="#">Relatório Detalhado</a></li>
            </ul>
        </div>
        @if(session('alert-warning'))
        <div class="alert alert-warning">
            {{ session('alert-warning') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Filtro</h3>
                </div>
                <div class="tile-body">
                    <form action="{{ route('pesquisarreembolsos.search') }}" method="post">
                        @csrf
                        <input id="search" class="form-control input-md" type="text" name="search" placeholder="Nome ou Natureza Operação">
                    </form>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="tabela" class="table table-hover thead-light table table-striped table table-bordered">
                        <thead class="text-primary" style="text-align: center;">
                            <tr>
                                <th>
                                    Código
                                </th>
                                <th>
                                    Responsavel
                                </th>
                                <th>
                                    Data
                                </th>
                                <th>
                                    Natureza Operação
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Centro de Custo
                                </th>
                                <th>
                                    Tipo
                                </th>
                                <th>
                                    Tipo de Movimentação
                                </th>
                                <th>
                                    Valor
                                </th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            @forelse($reembolsos as $reembolso)
                                <tr>
                                    <td>{{$reembolso->id}}</td>
                                    <td>{{$reembolso->usuario_id}}</td>
                                    <td>{{ $reembolso->data }}</td>
                                    <td>{{ $reembolso->gasto_id }}</td>
                                    <td>{{ $reembolso->status }}</td>
                                    <td>{{ $reembolso->centrocusto_id }}</td>
                                    <td>{{ $reembolso->tipo }}</td>
                                    <td>{{ $reembolso->movimento }}</td>
                                    <td>{{ $reembolso->valor }}</td>

                                    @empty
                                        <p class="alert-warning" style="font-size:22px;"center>Nenhum Reembolso
                                            Cadastrado
                                        </p>
                            @endforelse
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    document.getElementById("menuclique").click()
</script>
@endpush
