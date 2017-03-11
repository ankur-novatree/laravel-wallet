<?php
/**
 * Created by PhpStorm.
 * User: monoit
 * Date: 29/5/16
 * Time: 12:49 AM
 */
namespace Novatree\Wallet;
use Mockery\CountValidator\Exception;
use Novatree\Wallet\model\AccountModel;
use Novatree\Wallet\model\AccountTypeModel;
use Novatree\Wallet\model\TransactionTypeModel;
use Novatree\Wallet\model\UserTotalBalance;
use DB;

class WalletApi {

    /**
     * This method is used for create a transaction
     * @param $account_type is account type id
     * @param $transaction_type is transaction type id
     * @param $amount is transaction amount it could be positive or negative depends on demand
     * @param $date is Transaction date
     * @param $user_id is user id from transaction
     * @param int $transaction_status is transaction status will be 0 => Inactive or 1 => Active
     * @return array
     */

    public function createTransaction($account_type,$transaction_type,$amount,$date,$user_id,$transaction_status = 1) {
        try {
            $account_model = new AccountModel();
            $account_model->create([
                'user_id' => $user_id,
                'amount' => $amount,
                'account_type' => $account_type,
                'transaction_type' => $transaction_type,
                'transaction_date' => $date,
                'transaction_status' => $transaction_status
            ]);
            if($transaction_status == 1) {
                $this->updateUserTotalBalance($user_id, $amount);
            }
            return array('success' => 'Transaction successfully created');
        }
        catch(Exception $e) {
            return array('error' => 'Something wrong!');
        }
    }
    /**
     * This method is used for get transaction user wise
     * @param $user_id
     * @param $transaction_id
     * @param $transaction_date
     * @param $account_type
     * @param $transaction_type
     * @param $transaction_status
     * @return
     */
    public function getUserTransaction($user_id,$transaction_id=0,$transaction_date=null,$account_type=null,$transaction_type = null,$transaction_status = null) {
        try {
            if (!$user_id) {
                $account_model = new AccountModel();
                $data = array();
                $data = $account_model->where('user_id', '=', $user_id)
                    ->where(function ($query) use ($transaction_id) {
                        return $query->where('id','=',$transaction_id);
                    })
                    ->where(function ($query) use ($transaction_date) {
                        if($transaction_date != null) {
                            return $query->where('transaction_date','=',$transaction_date);
                        }
                    })
                    ->where(function ($query) use ($transaction_type) {
                        if($transaction_type != null) {
                            return $query->where('transaction_type','=',$transaction_type);
                        }
                    })
                    ->where(function ($query) use ($account_type) {
                        if($account_type != null) {
                            return $query->where('account_type','=',$account_type);
                        }
                    })
                    ->where(function ($query) use ($transaction_status) {
                        if($transaction_status != null) {
                            return $query->where('transaction_status','=',$transaction_status);
                        }
                    })
                    ->get()->toArray();
                return $data;
            }
            else {
                return array('error' => 'Please give a valid user id');
            }
        }
        catch(Exception $e) {
            return array('error' => 'Something wrong');
        }
    }
    /**
     * @param $name
     * @param $code
     * @param $status
     * @return array
     * This method is used for create account type
     */
    public function CreateAccountType($name,$code,$status) {
        try {
            $account_type_model = new AccountTypeModel();
            $account_type_model->create([
                'name' => $name,
                'code' => $code,
                'status' => $status
            ]);
            return array('success');
        }
        catch(Exception $e) {
            return array('error');
        }
    }
    /**
     * @param $code
     * @param $status
     * @return array
     * This method is used for create transaction type
     */
    public function CreateTransactionType($code,$status) {
        try {
            $transaction_model = new TransactionTypeModel();
            $transaction_model->create([
                'code' => $code,
                'status' => $status
            ]);
            return array('success');
        }
        catch(Exception $e) {
            return array('error');
        }
    }
    /**
     * This method is used for update user total balance
     */
    public function updateUserTotalBalance($user_id,$amount) {
        $user_total_balance_model = new UserTotalBalance();
        $user_total = $user_total_balance_model->find($user_id);
        if(!empty($user_total)) {
            $user_total->total_balance += $amount;
            $user_total->save();
        }
        else {
            $user_total_balance_model->create([
                'user_id'       => $user_id,
                'total_balance' => $amount,
                'modify_date'   => date('Y-m-d H:i:s'),
            ]);
        }
    }
    /**
     * This method is used for fetch user wise balance by user Id
     */
    public function fetchUserBalance($user_id) {
        $user_total_balance_model = new UserTotalBalance();
        $user_total = $user_total_balance_model->where('user_id','=',$user_id)->get()->toArray();
        $balance = 0;
        if(!empty($user_total)) {
            $balance = $user_total[0]['total_balance'];
        }
        return $balance;
    }

    /**
     * This method is used for rebuild user total balance
     */
    public function rebuildUserTotalBalance($user_id = 0) {
        $user_total_balance_module = new UserTotalBalance();
        $users_total = DB::table('account')
            ->select(DB::raw('sum(amount) as balance,user_id'))
            ->where(function ($query) use ($user_id){
                if($user_id != 0) {
                    $query->where('user_id','=',$user_id);
                }
            })
            ->where('transaction_type','=',1)
            ->groupBy('user_id')->get();
        $balance = 0;
        if(!empty($users_total)) {
            foreach ($users_total as $item) {
                $balance = $item->balance;
                $user_id = $item->user_id;
                $users_total_balance = $user_total_balance_module->where('user_id','=',$user_id)->get()->toArray();
                if(!empty($users_total_balance)) {
                    $users_total_balance_save = $user_total_balance_module->find($users_total_balance[0]['id']);
                    $users_total_balance_save->total_balance = $balance;
                    $users_total_balance_save->save();
                }
                else {
                    $user_total_balance_module->create([
                        'user_id' => $user_id,
                        'total_balance' => $balance,
                        'modify_date'  => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
        return TRUE;
    }

    /**
     * This method is used for delete a transaction by transaction id
     * @param $transaction_id
     * @return array
     */
    public function deleteTransaction($transaction_id)
    {
        if($transaction_id == '' || $transaction_id <= 0) {
            return array('error' => 'Please enter a valid transaction id');
        }
        else {
            $account_model =new AccountModel();
            $transaction = $account_model->where('id','=',$transaction_id)->get()->toArray();
            $transaction = array_shift($transaction);
            $delete_transaction = $account_model->find($transaction_id);
            $delete_transaction->delete();
            if($transaction['transaction_status'] == 1) {
                $user_total_model = new UserTotalBalance();
                $user_total = $user_total_model->find($transaction['user_id']);
                if(!empty($user_total)) {
                    $user_total->total_balance -= $transaction['amount'];
                    $user_total->save();
                }
            }
            return array('success'=>'Transaction successfully deleted');
        }

    }

    /**
     * This method is used for Active or Inactive a transaction by transaction id
     * @param $transaction_id
     * @param $transaction_status
     * @return array
     */

    public function activeInactiveTransaction($transaction_id,$transaction_status) {
        if($transaction_id == '' || $transaction_id <= 0) {
            return array('error' => 'Please enter a valid transaction id');
        }
        else if($transaction_status == '') {
            return array('error' => 'Please enter a valid status');
        }
        else {
            $account_model =new AccountModel();
            $transaction = $account_model->where('id','=',$transaction_id)->get()->toArray();
            $transaction = array_shift($transaction);
            $save_transaction = $account_model->find($transaction_id);
            $save_transaction->transaction_status = $transaction_status;
            $save_transaction->save();
            $user_total_model = new UserTotalBalance();
            if($transaction_status == 1) {
                $user_total = $user_total_model->find($transaction['user_id']);
                if(!empty($user_total)) {
                    $user_total->total_balance += $transaction['amount'];
                    $user_total->save();
                }
            }
            else {
                $user_total = $user_total_model->find($transaction['user_id']);
                if(!empty($user_total)) {
                    $user_total->total_balance -= $transaction['amount'];
                    $user_total->save();
                }
            }
            return array('success'=>'Transaction successfully deleted');
        }
    }

    public function test()
    {
        return 'This is test method';
    }
}