<?php

Route::get('account-type/','novatree\wallet\WalletController@showAccountTypeForm');
Route::post('account-type/','novatree\wallet\WalletController@saveAccountType');