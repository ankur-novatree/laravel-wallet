<?php

namespace Novatree\Wallet;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App;


class WalletServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $middleware = [
        'WalletMiddleware' => 'Novatree\Wallet\Middleware\WalletMiddleware'
    ];

    public function boot(Router $router)
    {
        require __DIR__ . '/Http/routes.php';
        $this->publishes([
            __DIR__.'/assets' => base_path('public/assets/wallet'),
            __DIR__.'/migrations' => base_path('database/migrations'),
        ]);
        $this->loadViewsFrom(__DIR__.'/views', 'wallet');
        parent::boot($router);
        foreach($this->middleware as $name => $class) {
            $router->middleware($name, $class);
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/Http/routes.php';
        $this->app->make('Novatree\Wallet\Http\Controllers\WalletController');
        $this->app->make('Novatree\Wallet\Http\Controllers\WalletAuthController');
        App::bind('walletapi', function()
        {
            return new Novatree\Wallet\Api\WalletApi;
        });
    }
}
