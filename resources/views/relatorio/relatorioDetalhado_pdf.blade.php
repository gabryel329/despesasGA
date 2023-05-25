<div class="row">
    <div class="col-12">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabela" class="table table-hover thead-light table-striped table-bordered">
                    <thead class="text-primary" style="text-align: center;">
                        <tr>
                            <th>Código</th>
                            <th>Responsável</th>
                            <th>Data</th>
                            <th>Natureza da Operação</th>
                            <th>Status</th>
                            <th>Centro de Custo</th>
                            <th>Tipo</th>
                            <th>Tipo de Movimentação</th>
                            <th>Valor</th>
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="alert-warning" style="font-size:22px; text-align: center;">Nenhum Reembolso Cadastrado</td>
                        </tr>
                        @endforelse
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
                @forelse ($somaEntrada as $saida)
                <p style="color: red"><strong>Saídas:</strong> R${{ $saida->somasaida }}</p>
                @empty
                <p>0</p>
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
</div>

<script>
    document.getElementById("menuclique").click();
</script>

