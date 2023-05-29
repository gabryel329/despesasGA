@extends('layouts.app')

@section('content')

<main class="app-content">

    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      </ul>
    </div>
    @if(session('alert-warning'))
        <div class="alert alert-warning">
            {{ session('alert-warning') }}
        </div>
    @endif
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
          <div class="info">
            <h4>Lançamentos</h4>
            @forelse ( $reembolsos as $reembolso )
                            <p><b>{{$reembolso->reembolsos}}</b></p>
                        @empty
                            <p><b>0 Lançamentos</b></p>
            @endforelse
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
                <h4>Lançamentos<br><span><p style="font-size: smaller;">(Em Abertos)</p></span></h4>
                @forelse ( $emAbertos as $emAberto )
                                <p><b>{{$emAberto->abertos}}</b></p>
                            @empty
                                <p><b>0 Em Abertos</b></p>
                @endforelse
              </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
          <div class="info">
            <h4>Lançamentos<br><span><p style="font-size: smaller;">(Glosados)</p></span></h4>
            @forelse ( $glosados as $glosado )
                            <p><b>{{$glosado->glosado}}</b></p>
                        @empty
                            <p><b>0 Glosados</b></p>
            @endforelse
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
          <div class="info">
            <h4>Lançamentos<br><span><p style="font-size: smaller;">(Reembolsados)</p></span></h4>
            @forelse ( $reembolsadas as $reembolsada )
                            <p><b>{{$reembolsada->reembolsadas}}</b></p>
                        @empty
                            <p><b>0 Reembolsados</b></p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Lançamentos Status %<br><span><p style="font-size: smaller;">(Por Usuario)</p></span></h3>
                <div class="embed-responsive embed-responsive-16by9" >
                    <div id="pieChartDemo" class="embed-responsive-item" width="100%" height="100%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Lançamentos por Mês<br><span><p style="font-size: smaller;">(Por Usuario)</p></span></h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <div id="chart2" class="embed-responsive-item" width="100%" height="100%" ></div>
                </div>
            </div>
        </div>
    </div>
  </main>


@endsection
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawPieChart);

      // Callback to draw the pie chart
      function drawPieChart() {
        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            ['Em Abertos: ',   @forelse ( $abertos as $aberto )
                                        {{$aberto->aberto}}
                                    @empty
                                        0
                                    @endforelse],

            ['Reembolsados: ',   @forelse ( $reembolsados as $reembolsado )
                                        {{$reembolsado->reembolsado}}
                                    @empty
                                        0
                                    @endforelse],

            ['Glosadas: ',   @forelse ( $glosados as $glosado )
                                        {{$glosado->glosado}}
                                    @empty
                                        0
                                    @endforelse],
        ]);

    // Set chart options
    let options = {
      title: 'Status',
      width: '100%',
      height: '100%'
    };

    // Instantiate and draw the pie chart
    var chart = new google.visualization.PieChart(document.getElementById('pieChartDemo'));
    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Mês');
      data.addColumn('number', 'Soma Entrada');
      data.addColumn('number', 'Soma Saída');

      data.addRows([
          @foreach ($data as $item)
              ['{{ $item->mes }}', {{ $item->soma_entrada }}, {{ $item->soma_saida }}],
          @endforeach
      ]);

      var options = {
          title: 'Lançamentos do Mês',
          legend: { position: 'none' },
          chartArea: { width: '80%', height: '70%' },
          vAxis: { title: 'Valor' },
          hAxis: { title: 'Mês' },
          colors: ['green', 'red']
      };

      var formatter = new google.visualization.NumberFormat({
        prefix: 'R$',
        groupingSymbol: '.',
        decimalSymbol: ',',
        decimalDigits: 2
      });
      formatter.format(data, 1); // Formata a coluna 1 (Soma Entrada) em formato de moeda
      formatter.format(data, 2); // Formata a coluna 2 (Soma Saída) em formato de moeda

      var chart = new google.visualization.ColumnChart(document.getElementById('chart2'));
      chart.draw(data, options);
    }
</script>

