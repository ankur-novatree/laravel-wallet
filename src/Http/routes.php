<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['namespace' =>'Novatree\Wallet\Http\Controllers','prefix' => 'admin'], function () {

    Route::get('account-type/{id?}',['middleware' => 'WalletMiddleware','uses' =>'WalletController@showAccountTypeForm']);
    Route::post('account-type/',['middleware' => 'WalletMiddleware','uses' =>'WalletController@saveAccountType']);

    Route::get('transaction-type/{id?}',['middleware' => 'WalletMiddleware','uses' =>'WalletController@showTransactionTypeForm']);
    Route::post('transaction-type/',['middleware' => 'WalletMiddleware','uses' =>'WalletController@saveTransactionType']);

    Route::get('view-transaction-type/',['middleware' => 'WalletMiddleware','uses' =>'WalletController@showTransactionType']);
    Route::get('view-account-type/',['middleware' => 'WalletMiddleware','uses' =>'WalletController@showAccountType']);

    Route::get('view-transaction/{transaction_id?}/{user_id?}',['middleware' => 'WalletMiddleware','uses' =>'WalletController@showTransaction']);

    Route::get('login','WalletAuthController@login');
    Route::post('login','WalletAuthController@doLogin');

    Route::get('dashboard',['middleware' => 'WalletMiddleware','uses' => 'WalletAuthController@dashboard']);
    Route::get('logout','WalletAuthController@logout');

    Route::get('change-password',['middleware' => 'WalletMiddleware','uses' => 'WalletAuthController@changePassword']);
    Route::post('change-password',['middleware' => 'WalletMiddleware','uses' => 'WalletAuthController@doChangePassword']);

    Route::get('rebuild-user-total/{user_id?}','WalletController@rebuildUserTotalBalance');

});