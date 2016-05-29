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
     * This method is used save account type
     */
    public function saveAccountType(Request $request) {
        try{
            $type_name = $request->type_name;
            $code      = $request->code;
            $status    = $request->status;
            $account_model = new AccountModel();
            $account_model->create([
                'name' => $type_name,
                'code' => $code,
                'status' => $status
            ]);
            return redirect('account-type')->with('success','Account type successfully added');
        }
        catch(Exception $e){
            return redirect('account-type')->with('error','Some error occurred');
        }
    }

    /**
     * This method is used show add Transaction type form
     */
    public function showTransactionTypeForm() {
        return view('wallet::transaction-type');
    }


    /**
     * This method is used show add account type form
     */
    public function saveTransactionType(Request $request) {
        try{
            $code      = $request->code;
            $status    = $request->status;
            $transaction_model = new TransactionTypeModel();
            $transaction_model->create([
              'code' => $code,
              'status' => $status
            ]);
            return redirect('transaction-type')->with('success','Transaction type successfully added');
        }
        catch(Exception $e){
            return redirect('transaction-type')->with('error','Some error occurred');
        }
    }
    
    /**
     * This method is used for show view account type
     */
    public function showAccountType() {
        $account_moder = new AccountModel();
        $data = array();
        $data = $account_moder->get()->toArray();
        return view('wallet::view-account-type',compact('data'));
    }

    /**
     * This method is used for show view transaction type
     */
    public function showTransactionType() {
        $transaction_model = new TransactionTypeModel();
        $data = array();
        $data = $transaction_model->get()->toArray();
        return view('wallet::view-transaction-type',compact('data'));
    }

}
