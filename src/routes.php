<?php

Route::get('account-type/','novatree\wallet\WalletController@showAccountTypeForm');
Route::post('account-type/','novatree\wallet\WalletController@saveAccountType');

Route::get('transaction-type/','novatree\wallet\WalletController@showTransactionTypeForm');
Route::post('transaction-type/','novatree\wallet\WalletController@saveTransactionType');

Route::get('view-transaction-type/','novatree\wallet\WalletController@showTransactionType');
Route::get('view-account-type/','novatree\wallet\WalletController@showAccountType');

Route::get('view-transaction/{transaction_id?}/{user_id?}','novatree\wallet\WalletController@showTransaction');

Route::get('admin/login','novatree\wallet\WalletAuthController@login');
Route::post('admin/login','novatree\wallet\WalletAuthController@doLogin');

Route::get('admin/dashboard',['middleware' => 'WalletMiddleware','uses' => 'novatree\wallet\WalletAuthController@dashboard']);