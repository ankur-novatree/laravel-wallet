<?php

namespace Novatree\Wallet;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Novatree\Wallet\AccountModel;
use Novatree\Wallet\AccountTypeModel;
use Novatree\Wallet\TransactionTypeModel;
use Novatree\Wallet\AdminLogin;
use Session;
use Illuminate\Support\Facades\Redirect;

class WalletAuthController extends Controller
{
    /**
     * This method is used for show admin login
     */
    public function login() {
        return view('wallet::admin-login');
    }

    /**
     * This method is used for do login
     */
    public function doLogin(Request $request) {
        $admin_login_model = new AdminLogin();
        $admin_details = $admin_login_model->where('username','=',$request->username)->get()->toArray();
        if(!empty($admin_details)) {
            if(password_verify($request->password,$admin_details[0]['password'])) {
                Session::put('admin_login',TRUE);
                Session::put('admin_user_id',$admin_details[0]['id']);
                return redirect('admin/dashboard');
            }
            else {
                return redirect('admin/login');
            }
        }
        else {
            return redirect('admin/login');
        }
    }
    
    /**
     * This method is used for show dashboard
     */
    public function dashboard() {
        echo "This is Dashboard";
    }
    
    /**
     * This method is used for logout
     */
    public function logot()
    {
        
    }
    
    /**
     * This method is used for show form of change admin password
     */
    public function changePassword()
    {
        
    }
    
    /**
     * This method is used for change admin password
     */
    public function doChangePassword()
    {
        
    }

}
