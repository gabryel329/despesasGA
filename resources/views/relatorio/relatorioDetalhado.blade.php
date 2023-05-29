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
                        <form action="{{ route('gerar.pdf') }}" method="GET" target="_blank">
                            @csrf
                            <input id="datainicio" value="{{$dataInicial}}" style="display: none;" name="datainicio" placeholder="" class="form-control input-md" required type="date">
                            <input id="datafim" value="{{$dataFinal}}" style="display: none;" name="datafim" placeholder="" class="form-control input-md" required type="date">
                            @forelse ($reembolsos as $reembolso )
                                <input id="centrocusto_id" value="{{$reembolso->centrocusto_id}}" style="display: none;" name="centrocusto_id" placeholder="" class="form-control input-md" required type="text">
                            @empty

                            @endforelse

                            <button type="submit" class="btn btn-primary">Gerar PDF</button>
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
                                    Corporativo
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
                                    <td>{{ $reembolso->corporativo }}</td>
                                    <td class="{{ $reembolso->movimento == 'Entrada' ? 'entrada' : 'saida' }}"><strong>{{ $reembolso->movimento }}</strong></td>
                                    <td>R${{ $reembolso->valor }}</td>

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
        <div class="row d-flex align-items-stretch">
            <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Valores</h3>
                <div>
                    @forelse ($somaEntrada as $entrada)
                        <p style="color: green"><strong>Entradas:</strong> R${{ $entrada->somaentrada }}</p>
                    @empty
                        <p>0</p>
                    @endforelse
                </div>
                <div>
                    @forelse ($somaSaida as $saida)
                        <p style="color: red"><strong>Saídas:</strong> R${{ $saida->somasaida }}</p>
                    @empty
                        <p>0</p>
                    @endforelse
                </div>
                <div>
                    @forelse ($total as $value)
                        <h3><strong>Total:</strong> R${{ $value->total }}</h3>
                        @if ($value->total < 0)
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
                    <div>
                        <div id="graficoBarras" class="embed-responsive-item"></div>
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Dados do gráfico
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Categoria');
        data.addColumn('number', 'Valor');
        data.addColumn({ type: 'string', role: 'style' }); // Coluna para definir as cores das barras
        data.addRows([
            ['Entradas', @forelse ($somaEntrada as $entrada) {{ $entrada->somaentrada }},'color: green'@empty 0,'color: green' @endforelse],
            ['Saídas', @forelse ($somaSaida as $saida) {{ $saida->somasaida }},'color: red'@empty 0,'color: red' @endforelse]
        ]);

        // Opções do gráfico
        var options = {
            title: 'Valores',
            legend: 'none', // Oculta a legenda
            hAxis: {
                title: 'Categoria'
            },
            vAxis: {
                title: 'Valor',
                format: "R$ ###,###.00"
            }
        };
        // Formatando os valores manualmente
        var formatter = new google.visualization.NumberFormat({ 
            prefix: 'R$ ',
            decimalSymbol: ',',
            groupingSymbol: '.',
            fractionDigits: 2
        });

        for (var i = 0; i < data.getNumberOfRows(); i++) {
            var value = data.getValue(i, 1);
            var formattedValue = formatter.formatValue(value);
            data.setFormattedValue(i, 1, formattedValue);
        }

        // Criação do gráfico de barras
        var chart = new google.visualization.ColumnChart(document.getElementById('graficoBarras'));
        chart.draw(data, options);
    }
</script>

@endpush
