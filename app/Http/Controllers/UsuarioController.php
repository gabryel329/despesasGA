<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = User::all();

        return view('usuario', compact('usuario'));
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
    // Valide os dados do formulário de cadastro
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|min:8|max:255|confirmed',
    ]);

    // Crie um novo usuário
    $user = new User;
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->admin = $request->get('admin');
    $user->password = Hash::make($validatedData['password']);
    $user->save();

    // Redirecione o usuário de volta para a página de login
    return redirect()->route('buscarusuarios.index')->with('success', 'Usuário cadastrado com sucesso!');
}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
