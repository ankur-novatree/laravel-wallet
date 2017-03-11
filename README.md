## Laravel/wallet

A simple wallet feature implementation for Laravel.

## Installation

Install the package through [Composer](http://getcomposer.org/). 

Run the Composer require command from the Terminal:

    composer require novatree/wallet

Now all you have to do is to add the service provider of the package and alias the package. To do this open your `config/app.php` file.

Add a new line to the `providers` array:

	Novatree\Wallet\WalletServiceProvider::class

And optionally add a new line to the `aliases` array:

	'Wallet' => Novatree\Wallet\Facades\WalletApiFacades::class

Now you're ready to start using the wallet feature in your application.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).