<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BuscarUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::orderBy('id', 'desc')->get();

        return view('buscar.buscar_usuarios', compact('usuarios'));
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
        $usuarios = User::find($id);

        if(!$usuarios)
            return redirect()->back();

        return view('buscar.detalhes_usuarios',compact('usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuarios = User::find($id);
        if(!empty($usuarios))
        {
            return view('buscar.editar_usuarios', ['usuarios'=>$usuarios]);
        }else{
            return redirect()->route('mostrarusuarios.show');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'admin' => $request->admin,
            'password' => Hash::make($request->password),
        ];

        User::where('id', $id)->update($data);
        return redirect()->route('mostrarusuarios.show', ['id' => $id])->with('success', 'Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($usuarios = User::find($id))
        {
            if($usuarios->delete()){
                return redirect()->route('buscarusuarios.index')->with('alert-warning','Deletado com Sucesso! ');
            }else{
                return redirect()->back()->with('alert-warning','Não pode deletar, possui dependentes ativos !');
            }
        }
        return redirect()->back()->with('alert-warning','Não foi possivel deletar! ');
    }

    public function search(Request $request)
    {
        $usuarios = User::where('name', 'LIKE', "%{$request->search}%")
                                ->orWhere('email', 'LIKE', "%{$request->search}%")
                                ->paginate();

        return view('buscar.buscar_usuarios',compact('usuarios'));
    }
}
