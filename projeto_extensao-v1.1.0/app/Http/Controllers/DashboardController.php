<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function index() {
        $usuarios = User::all()->count();
    
        // gráfico 1 - usuários
        $usersData = User::select([
            DB::raw('YEAR(created_at) as ano'),
            DB::raw('COUNT(*) as total')
        ])
        ->groupBy('ano')
        ->orderBy('ano', 'asc')
        ->get();
    
        foreach ($usersData as $user) {
            $ano[] = $user->ano;
            $total[] = $user->total;
        }
    
        $userLabel = "Comparativo de cadastro de usuários";
        $userAno = implode(',', $ano);
        $userTotal = implode(',', $total);
    
        // Inicializar arrays para categorias
        $catNome = [];
        $catTotal = [];
    
        // gráfico 2 - categorias com filtro para produtos criados
        if (auth()->user()->access_level === 'admin') {
            // Para admin, exibir todos os produtos
            $catData = Categoria::with('produtos')->get();
        } else {
            // Para fornecedores, apenas produtos criados por eles
            $catData = Categoria::whereHas('produtos', function ($query) {
                $query->where('id_user', auth()->id()); // Substitua 'id_user' pelo nome correto, se necessário
            })->with(['produtos' => function ($query) {
                $query->where('id_user', auth()->id()); // Substitua 'id_user' pelo nome correto, se necessário
            }])->get();
        }
    
        foreach ($catData as $cat) {
            $catNome[] = $cat->nome;
            $catTotal[] = $cat->produtos->count();
        }
    
        return view('admin.dashboard', compact('usuarios', 'userLabel', 'userAno', 'userTotal', 'catNome', 'catTotal'));
    }
    
    
}
