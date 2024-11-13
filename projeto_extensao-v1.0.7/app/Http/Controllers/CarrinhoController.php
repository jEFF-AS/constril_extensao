<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function carrinhoLista()
    {
        $itens = \Cart::getContent();
        return view('site.carrinho', compact('itens'));
    }

    public function adicionaCarrinho(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => abs($request->qnt),
            'attributes' => [
                'image' => $request->img
            ]
        ]);

        return redirect()->route('site.carrinho')->with('sucesso', 'Produto adicionado no carrinho com sucesso!');
    }

    public function removeCarrinho(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->route('site.carrinho')->with('sucesso', 'Produto removido do carrinho com sucesso!');
    }

    public function atualizaCarrinho(Request $request)
    {
        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => abs($request->quantity),
            ],
        ]);

        return redirect()->route('site.carrinho')->with('sucesso', 'Produto atualizado do carrinho com sucesso!');
    }

    public function limparCarrinho()
    {
        \Cart::clear();
        return redirect()->route('site.carrinho')->with('aviso', 'Seu carrinho está vazio!');
    }

    public function finalizarPedido()
    {
        $itens = \Cart::getContent();
        $total = \Cart::getTotal();
        $whatsappNumber = '5538999545880';
        $message = "Olá, sou o(a) " . ucfirst(auth()->user()->firstName) . ", quero fazer os seguintes pedidos:\n\n";

        foreach ($itens as $item) {
            $message .= "{$item->name} - R$ " . number_format($item->price, 2, ',', '.') . "\n";
        }

        $message .= "\nTotal: R$ " . number_format($total, 2, ',', '.');

        $url = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);

        // Limpar o carrinho após gerar o link
        \Cart::clear();

        return response()->json(['url' => $url]);
    }


}
