<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('admin.usuarios.users', compact('users'));
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
        // Validação dos dados do formulário, incluindo o domínio de email
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|regex:/@gmail\.com$/i', // Validação personalizada para @gmail.com
            'password' => 'required|min:8',
        ]);

        // Criação do usuário com senha criptografada
        $user = $request->all();
        $user['password'] = bcrypt($request->password);
        $user = User::create($user);

        // Autentica o usuário recém-criado e redireciona para o dashboard
        Auth::login($user);
        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        return view('site.profile', compact('user'));
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
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|regex:/@gmail\.com$/i|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('profile')->with('success', 'Perfil atualizado com sucesso.');
    }

    public function deleteProfile()
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        return redirect()->route('site.index')->with('success', 'Conta excluída com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.usuarios')
                ->with('sucesso', 'Usuário deletado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route(route: 'admin.usuarios')
                ->with('erro', 'Erro ao deletar o usuário.');
        }
    }

    public function updateAccessLevel(Request $request, $id)
    {
        $request->validate([
            'access_level' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->access_level = $request->access_level;
        $user->save();

        return redirect()->route('admin.usuarios')->with('sucesso', 'Nível de acesso atualizado com sucesso!');

    }
}
