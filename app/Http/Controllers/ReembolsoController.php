<?php

namespace App\Http\Controllers;

use App\Models\CentroCusto;
use App\Models\Gastos;
use App\Models\Reembolso;
use App\Models\User;
use Illuminate\Http\Request;

class ReembolsoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reembolso = Reembolso::all();
        $gastos = Gastos::get();
        $centrocustos = CentroCusto::get();
        $usuarios = User::get();

        return view('/reembolso', compact('reembolso', 'gastos', 'centrocustos', 'usuarios'));
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
        $reembolso = new Reembolso;
        $reembolso->status = "Em Aberto";
        $reembolso->valor = $request->get('valor');
        $reembolso->parcelas = $request->get('parcelas');
        $reembolso->forma_pgt = $request->get('forma_pgt');
        $reembolso->observacao = $request->get('observacao');
        $reembolso->data = $request->get('data');
        $reembolso->corporativo = $request->get('corporativo');
        $reembolso->tipo = $request->get('tipo');
        $reembolso->centrocusto_id = $request->get('centrocusto_id');
        $reembolso->gasto_id = $request->get('gasto_id');
        $reembolso->movimento = $request->get('movimento');

        // Obtendo o usuário logado pelo nome
        $user = User::where('name', auth()->user()->name)->first();

        // Verificando se o usuário foi encontrado
        if ($user) {
            $reembolso->usuario_id = $user->name;
        }

        // Upload de imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/arquivos/'), $imageName);
            $reembolso->image = $imageName;
        }

        $reembolso->save();

        return redirect()->route('buscarreembolsos.index')
            ->with('success', 'Reembolso cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reembolso $reembolso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reembolso $reembolso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reembolso $reembolso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reembolso $reembolso)
    {
        //
    }
}
