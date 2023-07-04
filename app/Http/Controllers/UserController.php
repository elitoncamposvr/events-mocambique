<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public readonly User $user;

    public function __construct(){
        $this->user = new User();
    }

    public function index()
    {
        return view('users', [
            'users' => DB::table('users')->paginate(15)
        ]);
    }

    public function create()
    {
        return view('users_create');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'O :attribute é obrigatório!',
            'nome.min' => 'É necessário no mínimo 4 caracteres no nome!',
            'email.email' => 'Digite um email válido!',
            'email.unique' => 'Este email já está cadastrado'
        ];

        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ], $messages);

        $created = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($created) {
            return redirect()->route('users')->with('success', 'Usuário criado com sucesso!');
        }

        return redirect()->route('users')->with('error', 'Erro ao criar usuário!');
    }

    public function show(User $user)
    {
        return view('users_show', ['user' => $user]);
    }

    public function destroy(string $id)
    {
        $this->user->where('id', $id)->delete();

        return redirect()->route('users')->with('success', 'Deletado com sucesso!');
    }
}
