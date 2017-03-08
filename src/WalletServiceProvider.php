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
       /* $this->publishes([
          __DIR__.'/views' => base_path('resources/views/novatree/wallet'),
        ]);
        $this->publishes([
          __DIR__.'/migrations' => base_path('database/migrations'),
        ]);*/
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
        include __DIR__.'/routes.php';
        $this->app->make('Novatree\Wallet\WalletController');
        $this->app->make('Novatree\Wallet\WalletAuthController');
        App::bind('walletapi', function()
        {
            return new \Novatree\Wallet\WalletApi;
        });
    }
}
