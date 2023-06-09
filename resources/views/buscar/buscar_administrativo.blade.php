@extends('layouts.app')
<style>
        .entrada {
            color: green;
        }

        .saida {
            color: red;
        }
    </style>
@section('content')
    <div class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Lista de Lançamentos</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Administrativo</li>
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
                <div class="table-responsive-md">
                    <table id="tabela" class="table table-hover thead-light table table-striped table table-bordered">
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
                                <th>
                                    Centro de Custo
                                </th>
                                <th>
                                    Tipo
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
                                    <td>{{ $reembolso->centrocusto_id }}</td>
                                    <td>{{ $reembolso->tipo }}</td>
                                    <td class="{{ $reembolso->movimento == 'Entrada' ? 'entrada' : 'saida' }}"><strong>{{ $reembolso->movimento }}</strong></td>
                                    <td>{{ $reembolso->status }}</td>
                                    {{-- <td>
                                        <button type="button" class="btn btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            <a><i class="fa fa-edit" aria-hidden="true"></i></a>
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
                                                                <img src="/img/arquivos/{{ $reembolso->image }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td> --}}
                                    <td>
                                        <form action="{{ route('buscarreembolsos.destroy', $reembolso->id) }}" method="post"
                                            class="ms-2">
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
    </div>
@endsection
@push('scripts')
<script>
    document.getElementById("menuclique").click()
</script>
@endpush
