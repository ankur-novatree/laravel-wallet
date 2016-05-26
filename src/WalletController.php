<?php

namespace Novatree\Wallet;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Novatree\Wallet\AccountModel;
use Novatree\Wallet\AccountTypeModel;
use Novatree\Wallet\TransactionTypeModel;


class WalletController extends Controller
{
    /**
     * This method is used show add account type form
     */
    public function showAccountTypeForm() {
        return view('wallet::account');
    }

    /**
     * This method is used show add account type form
     */
    public function saveAccountType(Request $request) {
        $type_name = $request->type_name;
        $code      = $request->code;
        $status    = $request->status;
        $account_model = new AccountModel();
        $account_model->create([
            'name' => $type_name,
            'code' => $code,
            'status' => $status
        ]);
        return redirect('account-type');
    }

}
