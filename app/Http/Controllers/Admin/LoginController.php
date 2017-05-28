<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        //获取用户的输入信息
    	if ($input = Input::all())
    	{
    		$code = new \Code;
    		$_code = $code->get();
            //将输入的验证码的字母改为大写
    		if (strtoupper($input['code']) != $_code)
    		{
    			return back()->with('msg','验证码错误');
    		}
            //读取数据库中的用户信息
    		$user = User::first();
    		if ($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass'])
    		{
    			return back()->with('msg','用户名或密码错误');
    		}
            //将用户的信息传到session
    		session(['user'=>$user]);
    		return redirect('admin');

    	}
    	else
    	{
            //session(['user'=>null]);
    		return view('admin.login');
    	}
    	
    }
    //获取验证码
    public function code()
    {
    	$code = new \Code;
    	$code->make();
    }
    //注销
    public function quit()
    {
        session(['user'=>null]);
        return view('admin.login');
    }

    //test
    public function crypt()
    {
    	$str = '123456';
    	echo Crypt::encrypt($str);
    	
    }
}
