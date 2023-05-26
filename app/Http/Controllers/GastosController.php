<?php

namespace App\Http\Controllers;

use App\Models\Gastos;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gastos = Gastos::all();

        return view('/gastos', compact('gastos'));
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
            Gastos::create($request->all());
            $msg = ["msg" =>"sucesso"];
            return redirect()->route('buscargastos.index')->with('success', 'Tipo de Gasto cadastrado com sucesso!');
        }catch(\Exception $e)
        {

            return response()->json($e,404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Gastos $gastos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gastos $gastos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gastos $gastos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gastos $gastos)
    {
        //
    }
}
