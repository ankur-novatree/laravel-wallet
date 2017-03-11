## Laravel Wallet

A simple wallet feature implementation for Laravel.

## Installation

Install the package through [Composer](http://getcomposer.org/). 

Run the Composer require command from the Terminal:

    composer require novatree/wallet

Now all you have to do is to add the service provider of the package and alias the package. To do this open your `config/app.php` file.

Add a new line to the `providers` array:

	Novatree\Wallet\WalletServiceProvider::class

And optionally add a new line to the `aliases` array:

	'Wallet' => Novatree\Wallet\facades\WalletApiFacades::class

Now you're ready to start using the wallet feature in your application.

## Configuration

Publish the configuration for this package to further create tables. Run the following command:

	php artisan vendor:publish
	php artisan migrate

## Usage

To create a new account type for wallet, use createAccountType() method 

```php
Wallet::createAccountType($accountType, $machineName, $isActive);
```


To create a transaction type for wallet, use createTransactionType() method 

```php
Wallet::createTransactionType($transactionType, $status);
```


To do a transaction in wallet, use createTransaction() method 
```php
Wallet::createTransaction($account_type_id, $transaction_type_id, $amount, $transaction_date, $user_id, $transaction_status);
```

To get user's transaction for wallet, use getUserTransaction() method 
```php
Wallet::getUserTransaction($user_id,$transaction_id,$transaction_date,$account_type,$transaction_type,$transaction_status);
```

To get type of  all account, use getAccountTypes() method. To get all active account $status parameter should be 1, and 0 in case of inactive. 
```php
Wallet::getAccountTypes($status);
```

To get type of all transactions, use getTransactionTypes() method. To get all active transactions $status parameter should be 1, and 0 in case of inactive. 
```php
Wallet::getTransactionTypes($status);
```




## License

The Laravel Wallet is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).