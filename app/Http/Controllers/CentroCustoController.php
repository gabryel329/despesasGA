<?php

namespace App\Http\Controllers;

use App\Models\CentroCusto;
use Illuminate\Http\Request;

class CentroCustoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $centrocusto = CentroCusto::all();

        return view('centrocusto', compact('centrocusto'));
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
        try
        {
            CentroCusto::create($request->all());
            $msg = ["msg" =>"sucesso"];
            return redirect()->route('buscarcentrocusto.index')->with('success', 'Centro de Custo cadastrado com sucesso!');
        }catch(\Exception $e)
        {

            return response()->json($e,404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CentroCusto $centroCusto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CentroCusto $centroCusto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CentroCusto $centroCusto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CentroCusto $centroCusto)
    {
        //
    }
}
