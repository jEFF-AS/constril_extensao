<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/produto/{slug}', [SiteController::class, 'details'])->name('site.details');
Route::get('/categoria/{id}', [SiteController::class, 'categoria'])->name('site.categoria');

Route::get('/carrinho', [CarrinhoController::class, 'carrinhoLista'])->name('site.carrinho')->middleware(['authen', 'emailcheck']);
Route::post('/carrinho', [CarrinhoController::class, 'adicionaCarrinho'])->name('site.addcarrinho')->middleware(['authen', 'emailcheck']);
Route::post('/carrinho/remover', [CarrinhoController::class, 'removeCarrinho'])->name('site.removecarrinho');
Route::post('/carrinho/atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('site.atualizacarrinho');
Route::get('/carrinho/limpar', [CarrinhoController::class, 'limparCarrinho'])->name('site.limparcarrinho');
Route::post('/api/carrinho/finalizar', [CarrinhoController::class, 'finalizarPedido'])->name('api.finalizarpedido')->middleware(['authen', 'emailcheck']);

Route::view('/login', 'login.form')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/cadastro', [LoginController::class, 'create'])->name('login.create');
Route::post('/register', [UserController::class, 'store'])->name('login.store');

Route::middleware(['authen', 'adminOrVendor', 'emailcheck'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/produtos', [ProdutoController::class, 'index'])->name('admin.produtos');
    Route::delete('/admin/produto/delete/{id}', [ProdutoController::class, 'destroy'])->name('admin.produto.delete');
    Route::post('/admin/produto/store', [ProdutoController::class, 'store'])->name('admin.produto.store');
    Route::get('/admin/produtos/{id}/editar', [ProdutoController::class, 'edit'])->name('admin.produtos.edit');
    Route::put('/admin/produtos/{id}', [ProdutoController::class, 'update'])->name('admin.produtos.update');
});

Route::middleware(['authen', 'admin', 'emailcheck'])->group(function () {
    Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios');
    Route::patch('/admin/users/update-access-level/{user}', [UserController::class, 'updateAccessLevel'])->name('admin.users.updateAccessLevel');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::resource('categorias', CategoriaController::class);
});

Route::middleware(['authen', 'emailcheck'])->group(function () {
    Route::get('/perfil', [UserController::class, 'show'])->name('profile');
    Route::put('/perfil', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [UserController::class, 'deleteProfile'])->name('profile.delete');
});
