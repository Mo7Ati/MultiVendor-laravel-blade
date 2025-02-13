<?php

namespace App\Providers;

use App;
use App\Events\OrderCreated;
use App\Listeners\EmptyCart;
use App\Listeners\ProductDecrement;
use App\Repositries\Cart\CartModelRepository;
use App\Repositries\Cart\CartRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrap();

        $this->app->bind(CartRepository::class, CartModelRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::before(function ($user) {
            if ($user->super_admin === 1) {
                return true;
            }
        });

        foreach (config('abilities') as $ability_name => $ability_value) {
            Gate::define($ability_value, function ($user) use ($ability_value) {
                return $user->hasAbility($ability_value);
            });
        }
    }
}
