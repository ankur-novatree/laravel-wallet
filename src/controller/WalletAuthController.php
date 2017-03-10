<?php
namespace Novatree\Wallet\controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Novatree\Wallet\AccountModel;
use Novatree\Wallet\AccountTypeModel;
use Novatree\Wallet\TransactionTypeModel;
use Novatree\Wallet\AdminLogin;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
class WalletAuthController extends Controller
{
    function __construct()
    {
        //view()->share('admin_login', Session::get('admin_login'));
    }
    /**
     * This method is used for show admin login
     */
/*    public function login() {
        return view('wallet::admin-login');
    }*/
    /**
     * This method is used for do login
     */
/*    public function doLogin(Request $request) {
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
    }*/

    /**
     * This method is used for show dashboard
     */
/*    public function dashboard() {
        return view('wallet::dashboard');
    }*/

    /**
     * This method is used for logout
     */
/*    public function logout()
    {
        Session::forget('admin_login');
        Session::forget('admin_user_id');
        return redirect('admin/login');
    }*/

    /**
     * This method is used for show form of change admin password
     */
/*    public function changePassword()
    {
        return view('wallet::change-password');
    }*/

    /**
     * This method is used for change admin password
     */
/*    public function doChangePassword(Request $request)
    {
        $admin_login_model = new AdminLogin();
        $admin_details = $admin_login_model->where('id','=',Session::get('admin_user_id'))->get()->toArray();
        if($request->new_password != $request->confirm_password) {
            return redirect('admin/change-password')->with('error','New password and confirm password are not matched');
        }
        if(!empty($admin_details)) {
            if(password_verify($request->old_password,$admin_details[0]['password'])) {
                $new_password = Hash::make($request->new_password);
                $admin_details_save = $admin_login_model->find(Session::get('admin_user_id'));
                $admin_details_save->password = $new_password;
                $admin_details_save->save();
                return redirect('admin/dashboard')->with('success','Password successfully changed');
            }
            else {
                return redirect('admin/change-password')->with('error','Old password is not matched');
            }
        }
        else {
            return redirect('admin/login');
        }
    }*/
    public function test() {
        echo "This is test method";
    }
}