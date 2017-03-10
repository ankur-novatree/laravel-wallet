<?php
/*Route::group(['prefix' => 'admin'], function () {
    Route::get('account-type/{id?}',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showAccountTypeForm']);
    Route::post('account-type/',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@saveAccountType']);
    Route::get('transaction-type/{id?}',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showTransactionTypeForm']);
    Route::post('transaction-type/',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@saveTransactionType']);
    Route::get('view-transaction-type/',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showTransactionType']);
    Route::get('view-account-type/',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showAccountType']);
    Route::get('view-transaction/{transaction_id?}/{user_id?}',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showTransaction']);
    Route::get('login','novatree\wallet\WalletAuthController@login');
    Route::post('login','novatree\wallet\WalletAuthController@doLogin');
    Route::get('dashboard',['middleware' => 'WalletMiddleware','uses' => 'novatree\wallet\WalletAuthController@dashboard']);
    Route::get('logout','novatree\wallet\WalletAuthController@logout');
    Route::get('change-password',['middleware' => 'WalletMiddleware','uses' => 'novatree\wallet\WalletAuthController@changePassword']);
    Route::post('change-password',['middleware' => 'WalletMiddleware','uses' => 'novatree\wallet\WalletAuthController@doChangePassword']);
    Route::get('rebuild-user-total/{user_id?}','novatree\wallet\WalletController@rebuildUserTotalBalance');
});*/
Route::get('test','novatree\wallet\controller\WalletController@test');