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
            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h4 class="title">Detalhes</h4>
                    </div>
                    <div>
                        <p><strong>Data:</strong> {{ $dataInicial }}  <strong>Até</strong>  {{ $dataFinal }}</p>
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
        <div class="row d-flex align-items-stretch">
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Valores</h3>
                        <div>
                            @forelse ($somaEntrada as $entrada)
                                <p style="color: green"><strong>Entradas:</strong> R${{ $entrada->somaentrada }} </p>
                                @empty
                                    0
                            @endforelse
                        </div>
                        <div>
                            @forelse ($somaEntrada as $saida)
                                <p style="color: red"><strong>Saidas:</strong> R${{ $saida->somasaida }} </p>
                                @empty
                                    0
                            @endforelse
                        </div>
                        <div>
                            @forelse ($somaEntrada as $total)
                                <h3><strong>Total:</strong> R${{ $total->subtracao }}</h3>
                                @if ($total->subtracao < 0)
                                    <p style="color: red;">Total negativo!</p>
                                @endif
                            @empty
                                <p>0</p>
                            @endforelse
                        </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Gráfico de Comparação</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas id="graficoBarras" class="embed-responsive-item" width="100%" height="100%" ></canvas>
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

<!-- Script do Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Dados do gráfico
    var ctx = document.getElementById('graficoBarras').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Entradas', 'Saídas'],
            datasets: [{
                label: 'Valor',
                data: [ @forelse ($somaEntrada as $entrada)
                            {{ $entrada->somaentrada }}
                        @empty
                            0
                        @endforelse,
                        @forelse ($somaEntrada as $saida)
                            {{ $saida->somasaida }}
                        @empty
                            0
                        @endforelse],
                backgroundColor: ['green', 'red'],
                borderColor: ['green', 'red'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'R$' + value;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
