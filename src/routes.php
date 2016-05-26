<?php

Route::get('account-type/','novatree\wallet\WalletController@showAccountTypeForm');
Route::post('account-type/','novatree\wallet\WalletController@saveAccountType');

Route::get('transaction-type/','novatree\wallet\WalletController@showTransactionTypeForm');
Route::post('transaction-type/','novatree\wallet\WalletController@saveTransactionType');