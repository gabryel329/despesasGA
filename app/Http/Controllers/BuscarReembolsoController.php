<?php

namespace App\Http\Controllers;

use App\Models\CentroCusto;
use App\Models\Gastos;
use App\Models\Reembolso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuscarReembolsoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $userName = auth()->user()->name;

    $reembolsos = DB::select("SELECT r.* FROM reembolsos r
                INNER JOIN users u ON u.name = r.usuario_id
                WHERE u.name = ?", [$userName]);

    return view('buscar.buscar_reembolso', compact('reembolsos'));
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
        $reembolsos = Reembolso::find($id);

        if(!$reembolsos)
            return redirect()->back();

        return view('buscar.detalhes_reembolsos',compact('reembolsos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reembolsos = Reembolso::find($id);
        $gastos = Gastos::get();
        $usuarios = User::get();
        $centrocustos = CentroCusto::get();

        if(!empty($reembolsos))
        {
            return view('buscar.editar_reembolsos', ['reembolsos'=>$reembolsos, 'centrocustos'=>$centrocustos, 'gastos'=>$gastos, 'usuarios'=>$usuarios]);
        }else{
            return redirect()->route('mostrarreembolsos.show');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=[
            'valor' => $request->valor,
            'data' => $request->data,
            'usuario_id' => $request->usuario_id,
            'gasto_id' => $request->gasto_id,
            'centrocusto_id' => $request->centrocusto_id,
            'tipo' => $request->tipo,
            'status' => $request->status,
            'corporativo' => $request->corporativo,
            'forma_pgt' => $request->forma_pgt,
            'parcelas' => $request->parcelas,
            'observacao' => $request->observacao
        ];

        Reembolso::where('id', $id)->update($data);
        return redirect()->route('mostrarreembolsos.show', ['id' => $id])->with('success', 'Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($reembolsos = Reembolso::find($id))
        {
            if($reembolsos->delete()){
                return redirect()->route('buscarreembolsos.index')->with('alert-warning','Deletado com Sucesso! ');
            }else{
                return redirect()->back()->with('alert-warning','Não pode deletar, possui dependentes ativos !');
            }
        }
        return redirect()->back()->with('alert-warning','Não foi possivel deletar! ');
    }

    public function search(Request $request)
    {
        $reembolsos = Reembolso::where('nome', 'LIKE', "%{$request->search}%")
                                ->orWhere('tipo', 'LIKE', "%{$request->search}%")
                                ->paginate();

        return view('buscar.buscar_reembolso',compact('reembolsos'));
    }
}
