<?php

namespace App\Http\Controllers;

use App\Models\CentroCusto;
use App\Models\Gastos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                    COALESCE(SUM(CAST(r.valor AS DECIMAL(12, 2))), 0) AS valor,
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
                    LEFT JOIN reembolsos r ON EXTRACT(MONTH FROM r.created_at) = m.month
                    INNER JOIN users u ON u.name = r.usuario_id OR r.usuario_id IS NULL
                WHERE
                    u.name = '".$userName."'GROUP BY m.month, mes ORDER BY m.month");

        return view('/home', compact('users','reembolsos', 'emAbertos', 'reembolsadas', 'abertos', 'reembolsados',
        'data','glosados'));
    }

    public function filtroRelatorio()
    {
        $centrocustos = CentroCusto::get();
        $usuarios = User::get();

        return view('relatorio.filtro_relatorio', compact('centrocustos', 'usuarios'));
    }

    public function filtrar(Request $request)
    {

        $dataInicial = $request->get('datainicio');
        $dataFinal = $request->get('datafim');
        $centroCusto = $request->get('centrocusto_id');
        $status = $request->get('status');
        $cartaoCorporativo = $request->get('corporativo');
        $tipoMovimento = $request->get('movimento');
        $usuario = $request->get('usuario_id');

        $query = DB::table('reembolsos as r')
            ->select('r.id','r.valor', 'r.data', 'r.gasto_id', 'r.centrocusto_id', 'r.usuario_id', 'r.status', 'r.tipo', 'r.corporativo', 'r.movimento')
            ->join('gastos as g', 'g.nome', '=', 'r.gasto_id')
            ->join('centro_custos as c', 'c.nome', '=', 'r.centrocusto_id')
            ->join('users as u', 'u.name', '=', 'r.usuario_id')
            ->groupBy('r.id','r.valor', 'r.data', 'r.gasto_id', 'r.centrocusto_id', 'r.usuario_id', 'r.status', 'r.tipo', 'r.corporativo', 'r.movimento')
            ->orderBy('r.data', 'asc');

        if (!empty($dataInicial) && !empty($dataFinal)) {
            $query->whereBetween('r.data', [$dataInicial, $dataFinal]);
        }

        if (!empty($centroCusto)) {
            $query->where('r.centrocusto_id', $centroCusto);
        }

        if (!empty($status)) {
            $query->where('r.status', $status);
        }

        if (!empty($cartaoCorporativo)) {
            $query->where('r.corporativo', $cartaoCorporativo);
        }

        if (!empty($tipoMovimento)) {
            $query->where('r.movimento', $tipoMovimento);
        }

        if (!empty($usuario)) {
            $query->where('r.usuario_id', $usuario);
        }

        $reembolsos = $query->get();

        return view('relatorio.relatorioDetalhado', compact('reembolsos'));
    }

    public function lista()
    {
        $reembolsos = DB::table('reembolsos')->get();

        return view('relatorio.relatorioDetalhado', compact('reembolsos'));
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
