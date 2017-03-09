<?php

namespace Novatree\Wallet;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Novatree\Wallet\AccountModel;
use Novatree\Wallet\AccountTypeModel;
use Novatree\Wallet\TransactionTypeModel;
use Session;

class WalletController extends Controller
{
    function __construct()
    {
        view()->share('admin_login', Session::get('admin_login'));
    }

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
            $account_model = new AccountTypeModel();
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
        $account_type_model = new AccountTypeModel();
        $data = array();
        $data = $account_type_model->get()->toArray();
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

    /**
     * This method is used for show transaction by id or all
     */
    public function showTransaction($transaction_id = 0,$user_id = 0) {
        $account_model = new AccountModel();
        $transaction = $account_model->where(function ($query) use ($transaction_id) {
            if($transaction_id !=0 || $transaction_id != '') {
                return $query->where('id','=',$transaction_id);
            }
        })->where(function ($query) use ($user_id) {
            if($user_id != 0 || $user_id != '') {
                return $query->where('user_id','=',$user_id);
            }
        })->get()->toArray();
        return view('wallet::view-transaction',compact('transaction'));
    }

}
