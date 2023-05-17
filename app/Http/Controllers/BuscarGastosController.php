<?php

namespace App\Http\Controllers;

use App\Models\Gastos;
use Illuminate\Http\Request;

class BuscarGastosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gastos = Gastos::get();

        return view('buscar.buscar_gastos', compact('gastos'));
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
        $gastos = Gastos::find($id);

        if(!$gastos)
            return redirect()->back();

        return view('buscar.detalhes_gastos',compact('gastos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gastos = Gastos::find($id);
        if(!empty($gastos))
        {
            return view('buscar.editar_gastos', ['gastos'=>$gastos]);
        }else{
            return redirect()->route('mostrargastos.show');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=[
            'nome' => $request->nome,
            'observacao' => $request->observacao
        ];

        Gastos::where('id', $id)->update($data);
        return redirect()->route('mostrargastos.show', ['id' => $id])->with('success', 'Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($gastos = Gastos::find($id))
        {
            if($gastos->delete()){
                return redirect()->route('buscargastos.index')->with('alert-warning','Deletado com Sucesso! ');
            }else{
                return redirect()->back()->with('alert-warning','Não pode deletar, possui dependentes ativos !');
            }
        }
        return redirect()->back()->with('alert-warning','Não foi possivel deletar! ');
    }

    public function search(Request $request)
    {
        $gastos = Gastos::where('nome', 'LIKE', "%{$request->search}%")
                                ->orWhere('observacao', 'LIKE', "%{$request->search}%")
                                ->paginate();

        return view('buscar.buscar_gastos',compact('gastos'));
    }
}
