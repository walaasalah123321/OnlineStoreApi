<?php

namespace App\Providers;

use App\Http\Repostries\AuthRepostry;
use App\Http\Repostries\CartRepostry;
use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\CartInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Repostries\ProductRepostry;
use App\Http\Interfaces\ProductInterface;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthRepostry::class);
        $this->app->bind(ProductInterface::class, ProductRepostry::class);
        $this->app->bind(CartInterface::class, CartRepostry::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
