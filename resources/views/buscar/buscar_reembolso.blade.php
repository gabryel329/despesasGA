@extends('layouts.app')

@section('content')
    <div class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Lista de Lançamentos</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Buscar</li>
                <li class="breadcrumb-item"><a href="#">Lançamentos</a></li>
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
            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title">Filtro</h3>
                        <p><a class="btn btn-primary icon-btn" href="/reembolso"><i class="fa fa-file"></i>Novo</a></p>
                    </div>
                    <div class="tile-body">
                        <form action="{{ route('pesquisarreembolsos.search') }}" method="post">
                            @csrf
                            <input id="search" class="form-control input-md" type="text" name="search" placeholder="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabela" class="table table-hover thead-light table-striped table-bordered">
                            <thead class="text-primary" style="text-align: center;">
                                <tr>
                                    <th>
                                        Código
                                    </th>
                                    <th>
                                        Responsável
                                    </th>
                                    <th>
                                        Data
                                    </th>
                                    <th>
                                        Tipo de Gasto
                                    </th>
                                    <th>
                                        Valor
                                    </th>
                                    {{-- <th>
                                        Centro de Custo
                                    </th> --}}
                                    <th>
                                        Observação
                                    </th>
                                    <th>
                                        Tipo de Movimento
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Excluir
                                    </th>
                                    <th>
                                        Detalhes
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
                                        <td>R${{ $reembolso->valor }}</td>
                                        {{-- <td>{{ $reembolso->centrocusto_id }}</td> --}}
                                        <td>{{ $reembolso->observacao }}</td>
                                        <td class="{{ $reembolso->movimento == 'Entrada' ? 'entrada' : 'saida' }}"><strong>{{ $reembolso->movimento }}</strong></td>
                                        <td>{{ $reembolso->status }}</td>
                                        <td>
                                            <form action="{{ route('buscarreembolsos.destroy', $reembolso->id) }}" method="post" class="ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm">
                                                    <i class="fa fa-trash center" style="color: red" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-sm">
                                                    <a href="{{ route('mostrarreembolsos.show', $reembolso->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <p class="alert-warning" style="font-size:22px; text-align: center;">Nenhum Reembolso Cadastrado</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
