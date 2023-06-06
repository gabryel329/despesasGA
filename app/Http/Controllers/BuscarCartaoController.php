<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use Illuminate\Http\Request;

class BuscarCartaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartaos = Cartao::orderBy('id', 'desc')->get();

        return view('buscar.buscar_cartao', compact('cartaos'));
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
        $cartaos = Cartao::find($id);

        if(!$cartaos)
            return redirect()->back();

        return view('buscar.detalhes_cartao',compact('cartaos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cartaos = Cartao::find($id);
        if(!empty($cartaos))
        {
            return view('buscar.editar_cartao', ['cartaos'=>$cartaos]);
        }else{
            return redirect()->route('mostrarcartaos.show');
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

        Cartao::where('id', $id)->update($data);
        return redirect()->route('mostrarcartaos.show', ['id' => $id])->with('success', 'Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($cartaos = Cartao::find($id))
        {
            if($cartaos->delete()){
                return redirect()->route('buscarcartaos.index')->with('alert-warning','Deletado com Sucesso! ');
            }else{
                return redirect()->back()->with('alert-warning','Não pode deletar, possui dependentes ativos !');
            }
        }
        return redirect()->back()->with('alert-warning','Não foi possivel deletar! ');
    }

    public function search(Request $request)
    {
        $cartaos = Cartao::where('nome', 'LIKE', "%{$request->search}%")
                                ->orWhere('observacao', 'LIKE', "%{$request->search}%")
                                ->paginate();

        return view('buscar.buscar_cartao',compact('cartaos'));
    }
}
