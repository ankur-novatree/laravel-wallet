<?php
/**
 * Created by PhpStorm.
 * User: monoit
 * Date: 29/5/16
 * Time: 11:41 AM
 */
namespace Novatree\Wallet\facades;
use Illuminate\Support\Facades\Facade;
class WalletApiFacades extends Facade{
    protected static function getFacadeAccessor() { return 'walletapi'; }
}