@extends('layouts.app')

@section('content')
    <div class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Lista de Tipo de Gastos</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Administrativo</li>
                <li class="breadcrumb-item"><a href="#">Tipo de Gastos</a></li>
            </ul>
        </div>
        @if(session('alert-warning'))
        <div class="alert alert-warning">
            {{ session('alert-warning') }}
        </div>
    @endif
        <div class="row">
            <div class="card-body">

                <form action="{{ route('pesquisargastos.search') }}" method="post">
                    @csrf
                    <div class="col-md-6">
                        <span class="input-group-addon">Filtro</span>
                        <input id="search" class="form-control input-md" type="text" name="search" placeholder="Nome ou CPF">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="tabela" class="table table-hover thead-light table table-striped table table-bordered">
                        <thead class="text-primary" style="text-align: center;">
                            <tr>
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Observacao
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
                            @forelse($gastos as $gasto)
                                <tr>
                                    <td>{{ $gasto->nome }}</td>
                                    <td>{{ $gasto->observacao }}</td>
                                    <td>
                                        <form action="{{ route('buscargastos.destroy', $gasto->id) }}" method="post"
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
                                                <a href="{{ route('mostrargastos.show', $gasto->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </button>
                                        </div>
                                    </td>
                                @empty
                                    <p class="alert-warning" style="font-size:22px;"center>Nenhum Tipo de Gasto
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
