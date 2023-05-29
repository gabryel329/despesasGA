<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\CentroCusto;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contas = Conta::all();
        $centrocustos = CentroCusto::get();

        return view('/conta', compact('contas','centrocustos'));
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
        $conta = new Conta;
        $conta->observacao = $request->get('observacao');
        $conta->tipo = $request->get('tipo');
        $conta->centrocusto_id = $request->get('centrocusto_id');

        $conta->save();

        return redirect()->route('buscarconta.index')
            ->with('success', 'Conta cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conta $conta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conta $conta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conta $conta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conta $conta)
    {
        //
    }
}
