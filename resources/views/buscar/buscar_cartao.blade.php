@extends('layouts.app')

@section('content')
    <div class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Lista de Cartão</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Administrativo</li>
                <li class="breadcrumb-item"><a href="#">Cartão</a></li>
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
                        <p><a class="btn btn-primary icon-btn" href="/cartaos"><i class="fa fa-file"></i>Novo</a></p>
                    </div>
                    <div class="tile-body">
                        <form action="{{ route('pesquisarcartaos.search') }}" method="post">
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
                    <table id="tabela" class="table table-hover thead-light table table-striped table table-bordered">
                        <thead class="text-primary" style="text-align: center;">
                            <tr>
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Observação
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
                            @forelse($cartaos as $cartao)
                                <tr>
                                    <td>{{ $cartao->nome }}</td>
                                    <td>{{ $cartao->observacao }}</td>
                                    <td>
                                        <form action="{{ route('buscarcartaos.destroy', $cartao->id) }}" method="post"
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
                                                <a href="{{ route('mostrarcartaos.show', $cartao->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </button>
                                        </div>
                                    </td>
                                @empty
                                    <p class="alert-warning" style="font-size:22px;"center>Nenhum Tipo de Cartão
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
