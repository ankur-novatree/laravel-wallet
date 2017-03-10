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
     * This method is used for create transaction
     */
    public function createTransaction($account_type,$transaction_type,$amount,$date,$user_id) {
        try {
            $account_model = new AccountModel();
            $account_model->create([
                'user_id' => $user_id,
                'amount' => $amount,
                'account_type' => $account_type,
                'transaction_type' => $transaction_type,
                'transaction_date' => $date
            ]);
            $this->updateUserTotalBalance($user_id,$amount);
            return array('success');
        }
        catch(Exception $e) {
            return array('failure');
        }
    }
    /**
     * This method is used for get transaction user wise
     */
    public function getUserTransaction($user_id,$transaction_id=0,$transaction_date=null,$account_type=null,$transaction_type = null) {
        try {
            if (!$user_id) {
                $account_model = new AccountModel();
                $transaction_id_where = '';
                if ($transaction_id != 0) {
                    $transaction_id_where .= "'id','='," . $transaction_id;
                }
                $transaction_date_where = '';
                if ($transaction_date != NULL) {
                    $transaction_date_where .= "'transaction_date','='," . $transaction_date;
                }
                $transaction_type_where = '';
                if ($transaction_type != NULL) {
                    $transaction_type_where .= "'transaction_type','='," . $transaction_type;
                }
                $account_type_where = '';
                if ($account_type != NULL) {
                    $account_type_where .= "'account_type','='," . $account_type;
                }
                $data = array();
                $data = $account_model->where('user_id', '=', $user_id)
                    ->where($transaction_id_where)
                    ->where($transaction_date_where)
                    ->where($transaction_type_where)
                    ->where($account_type_where)
                    ->get()->toArray();
                return $data;
            }
            else {
                $return_string = json_encode(array('failure'));
                return $return_string;
            }
        }
        catch(Exception $e) {
            $return_string = json_encode(array('failure'));
            return $return_string;
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
            })->groupBy('user_id')->get();
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

    public function test()
    {
        return 'This is test method';
    }
}