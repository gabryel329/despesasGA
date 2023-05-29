<!DOCTYPE html>
<html>
<head>
    <style>
        /* Estilos CSS */
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            position: relative;
        }

        .background {
            background-color: #fff;
            padding: 20px;
            position: relative;
        }

        .watermark {
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            z-index: -1;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        .custom-table th, .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            word-wrap: break-word;
        }

        .custom-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            font-size: 22px;
            text-align: center;
        }

        .values-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            width: 100%;
        }

        .values-container .tile {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            font-size: 10px;
        }

        .values-container .col-md-12 {
            width: 10%;
            height: 20px;
            padding: 10px;
        }

        .header {
            text-align: left;
            margin-top: -10px;
            color:black;
        }

        .header h1 {
            text-align: center;
            color:black;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px 40px;
            background-color: #f2f2f2;
            text-align: center;
        }

        .content {
            padding-bottom: 50px; /* Altura do footer */
        }

    </style>
</head>
<body>
    <div class="background">
        <img src="{{ public_path('images/logo.png') }}" class="watermark" width="50" height="50">
        <div class="header">
            <h1>Relatório Detalhado</h1>
            <p style="text-decoration: underline;">Intervalo de Data: {{ $dataInicial }} - {{ $dataFinal }}</p>
        </div>
        <div class="container content">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabela" class="custom-table">
                                <col style="width: 5%;">
                                <col style="width: 10%;">
                                <col style="width: 10%;">
                                <col style="width: 10%;">
                                <col style="width: 10%;">
                                <col style="width: 20%;">
                                <col style="width: 10%;">
                                <col style="width: 10%;">
                                <col style="width: 15%;">
                                <thead>
                                    <tr>
                                        <th>Cód.</th>
                                        <th>Responsável</th>
                                        <th>Data</th>
                                        <th>Natureza da Operação</th>
                                        <th>Status</th>
                                        <th>Centro de Custo</th>
                                        <th>Corporativo</th>
                                        <th>Cartão</th>
                                        <th>Tipo</th>
                                        <th>Tipo de Movimentação</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reembolsos as $reembolso)
                                    <tr>
                                        <td>{{ $reembolso->id }}</td>
                                        <td>{{ $reembolso->usuario_id }}</td>
                                        <td>{{ $reembolso->data }}</td>
                                        <td>{{ $reembolso->gasto_id }}</td>
                                        <td>{{ $reembolso->status }}</td>
                                        <td>{{ $reembolso->centrocusto_id }}</td>
                                        <td>{{ $reembolso->corporativo }}</td>
                                        <td>{{ $reembolso->cartao_id }}</td>
                                        <td>{{ $reembolso->tipo }}</td>
                                        <td class="{{ $reembolso->movimento == 'Entrada' ? 'entrada' : 'saida' }}"><strong>{{ $reembolso->movimento }}</strong></td>
                                        <td>R${{ $reembolso->valor }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="alert-warning">Nenhum Reembolso Cadastrado</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Valores</h3>
                        @forelse ($somaEntrada as $entrada)
                        <p style="color: green"><strong>Entradas:</strong> R${{ $entrada->somaentrada }}</p>
                        @empty
                        <p>0</p>
                        @endforelse
                        @forelse ($somaSaida as $saida)
                        <p style="color: red"><strong>Saídas:</strong> R${{ $saida->somasaida }}</p>
                        @empty
                        <p>0</p>
                        @endforelse
                        <p>_________________________</p>
                        @forelse ($total as $total)
                        <h3><strong>Total:</strong> R${{ $total->total }}</h3>
                        @if ($total->total < 0)
                        <p style="color: red;">Total negativo!</p>
                        @endif
                        @empty
                        <p>0</p>
                        @endforelse
                </div>
            </div>
        </div>
        <div class="footer">
            <p>© 2012-2023 GA Informática</p>
        </div>
    </div>
</body>
</html>
