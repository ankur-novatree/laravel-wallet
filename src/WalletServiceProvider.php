<?php

namespace Novatree\Wallet;

use Illuminate\Support\ServiceProvider;
use App;

class WalletServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
          __DIR__.'/views' => base_path('resources/views/novatree/wallet'),
        ]);
        $this->publishes([
          __DIR__.'/migrations' => base_path('database/migrations'),
        ]);
        $this->publishes([
          __DIR__.'/css' => base_path('public/assets/css/wallet'),
        ]);
        $this->loadViewsFrom(__DIR__.'/views', 'wallet');
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
        App::bind('walletapi', function()
        {
            return new \Novatree\Wallet\WalletApi;
        });
    }
}
