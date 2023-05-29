<?php

namespace App\Http\Controllers;

use App\Models\Reembolso;
use Illuminate\Http\Request;

class BuscarAdministrativaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reembolsos = Reembolso::orderBy('id', 'desc')->get();

        return view('buscar.buscar_administrativo', compact('reembolsos'));
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
        if($reembolsos = Reembolso::find($id))
        {
            if($reembolsos->delete()){
                return redirect()->route('buscaradministrativo.index')->with('alert-warning','Deletado com Sucesso! ');
            }else{
                return redirect()->back()->with('alert-warning','Não pode deletar, possui dependentes ativos !');
            }
        }
        return redirect()->back()->with('alert-warning','Não foi possivel deletar! ');
    }
}
