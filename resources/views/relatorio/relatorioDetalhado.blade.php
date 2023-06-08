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
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h3 class="title">Filtro</h3>
                    </div>
                    <div class="tile-body">
                        <form action="{{ route('relatorioDetalhado.relatorio') }}" method="get">
                            @csrf
                            <div class="row">


                                <div class="col-6 col-md-4">
                                    <div class="form-group">
                                        <label for="datainicio">Data de Início:</label>
                                        <input type="date" class="form-control" id="datainicio1" name="datainicio" value="{{ request('datainicio') }}">
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group">
                                        <label for="datafim">Data de Término:</label>
                                        <input type="date" class="form-control" id="datafim1" name="datafim" value="{{ request('datafim') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Centro de Custo</label>
                                        <select class="select2 form-control" id="centrocusto_id" name="centrocusto_id">
                                            <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                            @foreach ($centrocustos as $centrocusto)
                                                <option value="{{$centrocusto->nome}}">{{$centrocusto->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Responsável</label>
                                        <select class="select2 form-control" id="usuario_id" name="usuario_id">
                                            <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                            @foreach ($usuarios as $usuario)
                                                <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                            <option value="Em Aberto">Em Aberto</option>
                                            <option value="Reembolsada">Reembolsada</option>
                                            <option value="Glosada">Glosada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3" id="parcelas3" >
                                    <label class="form-label">Cartão Corporativo</label>
                                    <select class="form-control" id="corporativo" name="corporativo">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Nao">Não</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label">Tipo de Movimento</label>
                                    <select class="form-control" id="movimento" name="movimento">
                                        <option disabled selected style="font-size:18px;color: black;">Escolha</option>
                                        <option value="Saida">Saída</option>
                                        <option value="Entrada">Entrada</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-danger" type="button" href="{{ route('relatorioDetalhado.relatorio') }}">Resetar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('gerar.pdf') }}" method="GET" target="_blank">
            @csrf
            <button type="submit" class="btn btn-primary" disabled>Gerar PDF</button>
        </form>
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
                                    Cartão
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
                                    <td>{{ $reembolso->cartao_id}}
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
