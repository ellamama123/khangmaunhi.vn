<?php

namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\FuncLib;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Modules\Models\User;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\CGlobal;

class LoginController extends Controller{

	public function __construct(){
		Loader::loadCSS('backend/css/login.css', CGlobal::$postHead);
	}
    public function getLogin($url=''){
		if(Session::has('user')){
            if($url === '' || $url === 'user'){
				return Redirect::route('admin.dashboard');
    		}else{
                return Redirect::to(FuncLib::buildUrlDecode($url));
    		}
    	}else{
			return view('Admin::login.login', []);
    	}
    }
    public function postLogin($url=''){
        if(Session::has('user')){
			if ($url === '' || $url === 'user'){
                return Redirect::route('admin.dashboard');
    		}else{
                return Redirect::to(FuncLib::buildUrlDecode($url));
    		}
    	}

    	$token = Request::get('_token', '');
    	$name = Request::get('name', '');
    	$pass = Request::get('password', '');

    	$error = '';

    	if(Session::token() === $token){
	    	if($name != '' && $pass != ''){
				if (strlen($name) < 5 || strlen($name) > 50 || preg_match('/[^A-Za-z0-9_\.@]/', $name) || strlen($pass) < 5) {
	    			$error = 'Không tồn tại tên đăng nhập!';
	    		}else{
					$user = User::getUserByName($name);
					if($user != ''){
	    				if($user->user_status == 0 || $user->user_status == -1){
	    					$error = 'Tài khoản đang bị khóa!';
	    				}elseif($user->user_status == 1){
	    					$encode_password = User::encode_password($pass);
                            if($user->user_pass == $encode_password){
								if($error == ''){
									$data = array(
										'user_id' => $user->user_id,
										'user_name' => $user->user_name,
										'user_full_name' => $user->user_full_name,
										'user_phone' => $user->user_phone,
										'user_mail' => $user->user_mail,
										'user_status' => $user->user_status,
										'user_created' => $user->user_created,
										'user_rid' => $user->user_rid,
										'user_type' => $user->type,
										'session_id' => $user->session_id,
									);

									Session::put('user', $data, 6*24);
									$new_sessid = Session::getId();
									User::updateLogin($user, $new_sessid);
								}
                                if(isset($data['user_id']) && $url === '' || $url === 'user') {
									return Redirect::route('admin.dashboard');
	    						}
	    					}else{
                                $error = 'Mật khẩu chưa đúng!';
	    					}
	    				}
	    			}else{
	    				$error = 'Không tồn tại tên đăng nhập!';
	    			}
	    		}
	    	}else{
	    		$error = 'Bạn vui lòng điền thông tin đăng nhập!';
	    	}
    	}

		return view('Admin::login.login',[
			'error'=>$error,
		]);
    }
    public function logout(){
        if(Session::has('user')){
			Session::forget('user');
        }
        return Redirect::route('login', array('url' => FuncLib::buildUrlEncode(URL::previous())));
    }
}