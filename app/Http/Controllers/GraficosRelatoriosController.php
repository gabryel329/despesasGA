<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use App\Models\CentroCusto;
use App\Models\Reembolso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\View;


class GraficosRelatoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->count();

        $userName = auth()->user()->name;

        $reembolsos = DB::select("SELECT count(r.id) as reembolsos FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE u.name = ?", [$userName]);

        $emAbertos = DB::select("SELECT count(r.id) as abertos FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Em Aberto' and u.name = ?", [$userName]);

        $reembolsadas = DB::select("SELECT count(r.id) as reembolsadas FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Reembolsada' and u.name = ?", [$userName]);

        //Grafico ABERTOSREEMBOLSADOS
        $abertos = DB::select("SELECT count(r.id) as aberto FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Em Aberto' and u.name = ?", [$userName]);

        $reembolsados = DB::select("SELECT count(r.id) as reembolsado FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Reembolsada' and u.name = ?", [$userName]);

        $glosados = DB::select("SELECT count(r.id) as glosado FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Glosada' and u.name = ?", [$userName]);
        //Fim Grafico ABERTOSREEMBOLSADOS

        //GRAFICO DE VALORES POR USUARIO

        $data = DB::select("WITH meses AS (SELECT generate_series(1, 12) AS month)
        SELECT
            COALESCE(SUM(CAST(CASE WHEN r.movimento = 'Entrada' THEN REPLACE(REPLACE(r.valor, '.', ''), ',', '.')::DECIMAL(12, 2) ELSE 0 END AS DECIMAL(12, 2))), 0) AS soma_entrada,
            COALESCE(SUM(CAST(CASE WHEN r.movimento = 'Saida' THEN REPLACE(REPLACE(r.valor, '.', ''), ',', '.')::DECIMAL(12, 2) ELSE 0 END AS DECIMAL(12, 2))), 0) AS soma_saida,
            CASE
                WHEN m.month = 1 THEN 'Janeiro'
                WHEN m.month = 2 THEN 'Fevereiro'
                WHEN m.month = 3 THEN 'Março'
                WHEN m.month = 4 THEN 'Abril'
                WHEN m.month = 5 THEN 'Maio'
                WHEN m.month = 6 THEN 'Junho'
                WHEN m.month = 7 THEN 'Julho'
                WHEN m.month = 8 THEN 'Agosto'
                WHEN m.month = 9 THEN 'Setembro'
                WHEN m.month = 10 THEN 'Outubro'
                WHEN m.month = 11 THEN 'Novembro'
                WHEN m.month = 12 THEN 'Dezembro'
            END AS mes
        FROM
            meses m
            LEFT JOIN reembolsos r ON EXTRACT(MONTH FROM r.data) = m.month
            INNER JOIN users u ON u.name = r.usuario_id OR r.usuario_id IS NULL
        WHERE
            u.name = '".$userName."'
        GROUP BY m.month, mes
        ORDER BY m.month");


        return view('/home', compact('users','reembolsos', 'emAbertos', 'reembolsadas', 'abertos', 'reembolsados',
        'data','glosados'));
    }

    public function relatorio(Request $request)
    {
        $centrocustos = CentroCusto::get();
        $usuarios = User::get();
        $cartaos = Cartao::get();
        $reembolsos = Reembolso::query();

        if ($request->has('datainicio') && $request->has('datafim') && !empty($request->datainicio) && !empty($request->datafim)){
            $reembolsos->whereBetween('data', [$request->datainicio, $request->datafim]);
        }

        if ($request->has('centrocusto_id') && !empty($request->centrocusto_id)) {
            $reembolsos->where('centrocusto_id', $request->centrocusto_id);
        }

        if ($request->has('status') && !empty($request->status)) {
            $reembolsos->where('status', $request->status);
        }

        if ($request->has('corporativo') && !empty($request->corporativo)) {
            $reembolsos->where('corporativo', $request->corporativo);
        }

        if ($request->has('movimento') && !empty($request->movimento)) {
            $reembolsos->where('movimento', $request->movimento);
        }

        if ($request->has('usuario_id') && !empty($request->usuario_id)) {
            $reembolsos->where('usuario_id', $request->usuario_id);
        }

        if ($request->has('cartao_id') && !empty($request->cartao_id)) {
            $reembolsos->where('cartao_id', $request->cartao_id);
        }

        $reembolsos = $reembolsos->get();

        $somaEntrada = DB::select("SELECT COALESCE(SUM(CAST(CASE WHEN r.movimento = 'Entrada' THEN REPLACE(REPLACE(r.valor, '.', ''), ',', '.')::DECIMAL(12, 2) ELSE 0 END AS DECIMAL(12, 2))), 0) AS somaentrada
        FROM reembolsos r
        WHERE 1=1
        ".($request->has('datainicio') && $request->has('datafim') && !empty($request->datainicio) && !empty($request->datafim) ? "AND r.data BETWEEN '{$request->datainicio}' AND '{$request->datafim}'" : "")."
        ".($request->has('centrocusto_id') && !empty($request->centrocusto_id) ? "AND r.centrocusto_id = '{$request->centrocusto_id}'" : "")."
        ".($request->has('status') && !empty($request->status) ? "AND r.status = '{$request->status}'" : "")."
        ".($request->has('corporativo') && !empty($request->corporativo) ? "AND r.corporativo = '{$request->corporativo}'" : "")."
        ".($request->has('movimento') && !empty($request->movimento) ? "AND r.movimento = '{$request->movimento}'" : "")."
        ".($request->has('usuario_id') && !empty($request->usuario_id) ? "AND r.usuario_id = '{$request->usuario_id}'" : "")."
        ".($request->has('cartao_id') && !empty($request->cartao_id) ? "AND r.cartao_id = '{$request->cartao_id}'" : "")."
        ");

        $somaSaida = DB::select("SELECT COALESCE(SUM(CAST(CASE WHEN r.movimento = 'Saida' THEN REPLACE(REPLACE(r.valor, '.', ''), ',', '.')::DECIMAL(12, 2) ELSE 0 END AS DECIMAL(12, 2))), 0) AS somasaida
        FROM reembolsos r
        WHERE 1=1
        ".($request->has('datainicio') && $request->has('datafim') && !empty($request->datainicio) && !empty($request->datafim) ? "AND r.data BETWEEN '{$request->datainicio}' AND '{$request->datafim}'" : "")."
        ".($request->has('centrocusto_id') && !empty($request->centrocusto_id) ? "AND r.centrocusto_id = '{$request->centrocusto_id}'" : "")."
        ".($request->has('status') && !empty($request->status) ? "AND r.status = '{$request->status}'" : "")."
        ".($request->has('corporativo') && !empty($request->corporativo) ? "AND r.corporativo = '{$request->corporativo}'" : "")."
        ".($request->has('movimento') && !empty($request->movimento) ? "AND r.movimento = '{$request->movimento}'" : "")."
        ".($request->has('usuario_id') && !empty($request->usuario_id) ? "AND r.usuario_id = '{$request->usuario_id}'" : "")."
        ".($request->has('cartao_id') && !empty($request->cartao_id) ? "AND r.cartao_id = '{$request->cartao_id}'" : "")."
        ");

        $total = DB::select("SELECT
        COALESCE(SUM(CAST(CASE WHEN r.movimento = 'Entrada' THEN REPLACE(REPLACE(r.valor, '.', ''), ',', '.')::DECIMAL(12, 2) ELSE 0 END AS DECIMAL(12, 2))), 0) -
        COALESCE(SUM(CAST(CASE WHEN r.movimento = 'Saida' THEN REPLACE(REPLACE(r.valor, '.', ''), ',', '.')::DECIMAL(12, 2) ELSE 0 END AS DECIMAL(12, 2))), 0) AS total
        FROM reembolsos r
        WHERE 1=1
        ".($request->has('datainicio') && $request->has('datafim') && !empty($request->datainicio) && !empty($request->datafim) ? "AND r.data BETWEEN '{$request->datainicio}' AND '{$request->datafim}'" : "")."
        ".($request->has('centrocusto_id') && !empty($request->centrocusto_id) ? "AND r.centrocusto_id = '{$request->centrocusto_id}'" : "")."
        ".($request->has('status') && !empty($request->status) ? "AND r.status = '{$request->status}'" : "")."
        ".($request->has('corporativo') && !empty($request->corporativo) ? "AND r.corporativo = '{$request->corporativo}'" : "")."
        ".($request->has('movimento') && !empty($request->movimento) ? "AND r.movimento = '{$request->movimento}'" : "")."
        ".($request->has('usuario_id') && !empty($request->usuario_id) ? "AND r.usuario_id = '{$request->usuario_id}'" : "")."
        ".($request->has('cartao_id') && !empty($request->cartao_id) ? "AND r.cartao_id = '{$request->cartao_id}'" : "")."
        ");

        return view('relatorio.relatorioDetalhado', compact('reembolsos', 'somaEntrada', 'somaSaida', 'total','usuarios', 'cartaos', 'centrocustos'));
    }

    public function gerarPDF(Request $request)
    {
        // Chame a função 'relatorio' para obter os dados necessários
        $data = $this->relatorio($request);

        // Extraia os dados retornados pela função 'relatorio'
        $reembolsos = $data['reembolsos'];
        $somaEntrada = $data['somaEntrada'];
        $somaSaida = $data['somaSaida'];
        $total = $data['total'];
        $usuarios = $data['usuarios'];
        $cartaos = $data['cartaos'];
        $centrocustos = $data['centrocustos'];

        // Renderize a visualização em HTML
        $html = view('relatorio.relatorioDetalhado_pdf', compact('reembolsos', 'somaEntrada', 'somaSaida', 'total', 'usuarios', 'cartaos', 'centrocustos'))->render();

        // Instancie o Dompdf
        $dompdf = new Dompdf();

        // Carregue o HTML no Dompdf
        $dompdf->loadHtml($html);

        // Renderize o PDF
        $dompdf->render();

        // Defina o nome do arquivo PDF gerado
        $filename = 'relatorioDetalhado.pdf';

        // Obtenha o conteúdo do PDF gerado
        $pdfContent = $dompdf->output();

        // Defina o cabeçalho Content-Type como PDF
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        // Crie uma resposta HTTP com o conteúdo do PDF e os cabeçalhos
        $response = response($pdfContent, 200, $headers);

        // Envie a resposta para download
        return $response;
    }

    public function graficosADM()
    {

        $reembolsos = DB::select("SELECT count(r.id) as reembolsos FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id");

        $emAbertos = DB::select("SELECT count(r.id) as abertos FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Em Aberto'");

        $reembolsadas = DB::select("SELECT count(r.id) as reembolsadas FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Reembolsada'");

        //Grafico ABERTOSREEMBOLSADOS
        $abertos = DB::select("SELECT count(r.id) as aberto FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Em Aberto'");

        $reembolsados = DB::select("SELECT count(r.id) as reembolsado FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Reembolsada'");

        $glosados = DB::select("SELECT count(r.id) as glosado FROM reembolsos r
                    INNER JOIN users u ON u.name = r.usuario_id
                    WHERE r.status = 'Glosada'");
        //Fim Grafico ABERTOSREEMBOLSADOS

        //GRAFICO DE VALORES do USUARIO

        $data = DB::select("WITH meses AS (SELECT generate_series(1, 12) AS month)
        SELECT
            COALESCE(SUM(CAST(CASE WHEN r.movimento = 'Entrada' THEN REPLACE(REPLACE(r.valor, '.', ''), ',', '.')::DECIMAL(12, 2) ELSE 0 END AS DECIMAL(12, 2))), 0) AS soma_entrada,
            COALESCE(SUM(CAST(CASE WHEN r.movimento = 'Saida' THEN REPLACE(REPLACE(r.valor, '.', ''), ',', '.')::DECIMAL(12, 2) ELSE 0 END AS DECIMAL(12, 2))), 0) AS soma_saida,
            CASE
                WHEN m.month = 1 THEN 'Janeiro'
                WHEN m.month = 2 THEN 'Fevereiro'
                WHEN m.month = 3 THEN 'Março'
                WHEN m.month = 4 THEN 'Abril'
                WHEN m.month = 5 THEN 'Maio'
                WHEN m.month = 6 THEN 'Junho'
                WHEN m.month = 7 THEN 'Julho'
                WHEN m.month = 8 THEN 'Agosto'
                WHEN m.month = 9 THEN 'Setembro'
                WHEN m.month = 10 THEN 'Outubro'
                WHEN m.month = 11 THEN 'Novembro'
                WHEN m.month = 12 THEN 'Dezembro'
            END AS mes
        FROM
            meses m
            LEFT JOIN reembolsos r ON EXTRACT(MONTH FROM r.data) = m.month
            INNER JOIN users u ON u.name = r.usuario_id OR r.usuario_id IS NULL
        GROUP BY m.month, mes
        ORDER BY m.month");

        return view('relatorio.graficoadministrativo', compact('reembolsos', 'emAbertos', 'reembolsadas', 'abertos', 'reembolsados',
        'data','glosados'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
