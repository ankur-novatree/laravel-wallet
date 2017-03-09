<?php
Route::get('admin/account-type/{id?}',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showAccountTypeForm']);
Route::post('admin/account-type/',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@saveAccountType']);

Route::get('admin/transaction-type/{id?}',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showTransactionTypeForm']);
Route::post('admin/transaction-type/',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@saveTransactionType']);

Route::get('admin/view-transaction-type/',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showTransactionType']);
Route::get('admin/view-account-type/',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showAccountType']);

Route::get('admin/view-transaction/{transaction_id?}/{user_id?}',['middleware' => 'WalletMiddleware','uses' =>'novatree\wallet\WalletController@showTransaction']);

Route::get('admin/login','novatree\wallet\WalletAuthController@login');
Route::post('admin/login','novatree\wallet\WalletAuthController@doLogin');

Route::get('admin/dashboard',['middleware' => 'WalletMiddleware','uses' => 'novatree\wallet\WalletAuthController@dashboard']);
Route::get('admin/logout','novatree\wallet\WalletAuthController@logout');

Route::get('admin/change-password',['middleware' => 'WalletMiddleware','uses' => 'novatree\wallet\WalletAuthController@changePassword']);
Route::post('admin/change-password',['middleware' => 'WalletMiddleware','uses' => 'novatree\wallet\WalletAuthController@doChangePassword']);


