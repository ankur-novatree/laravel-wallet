<?php

namespace Novatree\Wallet;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Novatree\Wallet\AccountModel;
use Novatree\Wallet\AccountTypeModel;
use Novatree\Wallet\TransactionTypeModel;


class WalletAuthController extends Controller
{
    /**
     * This method is used for show admin login
     */
    public function login()
    {
        return view('wallet::admin-login');
    }

    /**
     * This method is used for do login
     */
    public function doLogin(Request $request)
    {

    }

}
