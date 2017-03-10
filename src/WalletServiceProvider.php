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

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Novatree\Wallet\controller\WalletController');
        App::bind('walletapi', function()
        {
            return new \Novatree\Wallet\WalletApi;
        });
    }
}
