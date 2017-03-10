<?php
namespace Novatree\Wallet\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionTypeModel extends Model
{
  protected $table = 'transaction_types';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id','code','status'];

  protected $connection = 'mysql';
  public $timestamps = false;
}
