<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Produto;
use App\Policies\ProdutoPolicy;

class AuthenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Gate::policy(Produto::class, ProdutoPolicy::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('ver-produto', function(User $user, Produto $produto) {
            return $user->id === $produto->id_user;
        });
    }
}
