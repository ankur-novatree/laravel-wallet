<?php

namespace Novatree\Wallet;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
  protected $table = 'account';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id','user_id','amount','account_type','transaction_type','transaction_date'];

  protected $connection = 'mysql';
}
