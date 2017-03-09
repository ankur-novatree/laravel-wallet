<?php

namespace Novatree\Wallet;

use Illuminate\Database\Eloquent\Model;

class UserTotalBalance extends Model
{
  protected $table = 'user_total_balance';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id','user_id','total_balance','modify_date'];

  protected $connection = 'mysql';
  public $timestamps = false;
}
