<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Gate;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // return "index";
       $produtos = Produto::paginate(5);
       return view('site.home', compact('produtos'));
    }

    public function details($slug) {
        $produto = Produto::where('slug', $slug)->first();
        
        Gate::authorize('ver-produto', $produto);

        if(Gate::allows('ver-produto', $produto)) {
            return view('site.details', compact('produto'));
        };
        
        if (Gate::denies('ver-produto', $produto)) {
            return redirect()->route('site.index');
        }

        return view('site.details', compact('produto'));
    }

    public function categoria($id) {
        $categoria = Categoria::find($id);
        $produtos = Produto::where('id_categoria', $id)->paginate(10);
        return view('site.categoria', compact('produtos', 'categoria'));
    }
}