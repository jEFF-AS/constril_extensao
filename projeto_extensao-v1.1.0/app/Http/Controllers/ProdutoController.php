<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Produto;
use App\Models\Categoria;
use illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user(); // Obtém o usuário logado

        // Verifica o nível de acesso
        $produtos = Produto::with('categoria')
            ->when($user->access_level === 'vendor', function ($query) use ($user) {
                // Filtra apenas produtos do usuário logado se ele for um fornecedor
                $query->where('id_user', $user->id);
            })
            ->when($search, function ($query, $search) {
                // Filtro de pesquisa
                $query->where(function ($q) use ($search) {
                    $q->where('nome', 'LIKE', "%{$search}%")
                        ->orWhere('descricao', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(20);

        $categorias = Categoria::all();
        return view('admin.produtos', compact('produtos', 'categorias', 'search'));
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
        $produto = $request->all();

        if ($request->imagem) {
            $produto['imagem'] = $request->imagem->store('produtos');
        }

        // Gera um slug único
        $slugBase = Str::slug($request->nome);
        $slug = $slugBase;
        $contador = 1;

        while (Produto::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $contador;
            $contador++;
        }

        $produto['slug'] = $slug;
        Produto::create($produto);
        return redirect()->route('admin.produtos')->with('sucesso', 'Produto cadastrado com sucesso!');
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
        $produto = Produto::find($id);
        $categorias = Categoria::all(); // Carrega todas as categorias
        return view('admin.produtos.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produto = Produto::find($id);

        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'id_categoria' => 'required|exists:categorias,id',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Atualizar os dados
        $produto->nome = $request->input('nome');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');
        $produto->id_categoria = $request->input('id_categoria');

        // Verifica se há uma nova imagem para upload
        if ($request->hasFile('imagem')) {
            // Deleta a imagem antiga se houver
            if ($produto->imagem && \Storage::exists($produto->imagem)) {
                \Storage::delete($produto->imagem);
            }

            // Armazena a nova imagem e salva o caminho
            $produto->imagem = $request->file('imagem')->store('produtos');
        }

        $produto->save();

        return redirect()->route('admin.produtos')->with('sucesso', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::find($id);

        try {
            Gate::authorize('ver-produto', $produto); // Autoriza com base no objeto Produto
            $produto->delete(); // Deleta o produto se a autorização passar
            return redirect()->route('admin.produtos')->with('sucesso', 'Produto removido com sucesso!');
        } catch (AuthorizationException $e) {
            // Retorna para a página anterior com uma mensagem de erro
            return redirect()->back()->with('erro', 'Você não tem permissão para excluir este produto.');
        }
    }
}
