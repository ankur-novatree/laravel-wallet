<?php

namespace Novatree\Wallet;

use Illuminate\Database\Eloquent\Model;

class AdminLogin extends Model
{
  protected $table = 'admin_login';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['id','username','password'];

  protected $connection = 'mysql';
  public $timestamps = false;
}
