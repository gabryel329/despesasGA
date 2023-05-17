<?php

namespace App\Http\Controllers;

use App\Models\CentroCusto;
use Illuminate\Http\Request;

class BuscarCentroCustoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centrocustos = CentroCusto::get();

        return view('buscar.buscar_centrocusto', compact('centrocustos'));
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
    public function show($id)
    {
        $centrocustos = CentroCusto::find($id);

        if(!$centrocustos)
            return redirect()->back();

        return view('buscar.detalhes_centrocusto',compact('centrocustos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $centrocustos = CentroCusto::find($id);
        if(!empty($centrocustos))
        {
            return view('buscar.editar_centrocusto', ['centrocustos'=>$centrocustos]);
        }else{
            return redirect()->route('mostrarcentrocusto.show');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=[
            'nome' => $request->nome,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'observacao' => $request->observacao
        ];

        CentroCusto::where('id', $id)->update($data);
        return redirect()->route('mostrarcentrocusto.show', ['id' => $id])->with('success', 'Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($centrocustos = CentroCusto::find($id))
        {
            if($centrocustos->delete()){
                return redirect()->route('buscarcentrocusto.index')->with('alert-warning','Deletado com Sucesso! ');
            }else{
                return redirect()->back()->with('alert-warning','Não pode deletar, possui dependentes ativos !');
            }
        }
        return redirect()->back()->with('alert-warning','Não foi possivel deletar! ');
    }

    public function search(Request $request)
    {
        $centrocustos = CentroCusto::where('nome', 'LIKE', "%{$request->search}%")
                                ->orWhere('cidade', 'LIKE', "%{$request->search}%")
                                ->paginate();

        return view('buscar.buscar_centrocusto',compact('centrocustos'));
    }
}
