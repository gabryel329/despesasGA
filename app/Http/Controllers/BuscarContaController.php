<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscarContaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contas = Conta::orderBy('id', 'desc')->get();

        return view('buscar.buscar_conta', compact('contas'));
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
        $contas = Conta::find($id);

        if(!$contas)
            return redirect()->back();

        return view('buscar.detalhes_conta',compact('contas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contas = Conta::find($id);
        if(!empty($contas))
        {
            return view('buscar.editar_conta', ['contas'=>$contas]);
        }else{
            return redirect()->route('mostrarconta.show');
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

        Conta::where('id', $id)->update($data);
        return redirect()->route('mostrarconta.show', ['id' => $id])->with('success', 'Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($contas = Conta::find($id))
        {
            if($contas->delete()){
                return redirect()->route('buscarconta.index')->with('alert-warning','Deletado com Sucesso! ');
            }else{
                return redirect()->back()->with('alert-warning','Não pode deletar, possui dependentes ativos !');
            }
        }
        return redirect()->back()->with('alert-warning','Não foi possivel deletar! ');
    }

    public function search(Request $request)
    {
        $contas = Conta::where('nome', 'LIKE', "%{$request->search}%")
                                ->orWhere('observacao', 'LIKE', "%{$request->search}%")
                                ->paginate();

        return view('buscar.buscar_conta',compact('conta'));
    }
}
