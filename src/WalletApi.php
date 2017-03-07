<?php
/**
 * Created by PhpStorm.
 * User: monoit
 * Date: 29/5/16
 * Time: 12:49 AM
 */

namespace Novatree\Wallet;
use Mockery\CountValidator\Exception;
use Novatree\Wallet\AccountModel;
use Novatree\Wallet\AccountTypeModel;
use Novatree\Wallet\TransactionTypeModel;

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

}