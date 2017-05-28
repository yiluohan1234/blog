<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\User;
use App\Http\Requests;
class IndexController extends CommonController
{
    //管理员登录主页面
    public function index()
    {
    	return view('admin.index');
    }
    //当前系统的信息
    public function info()
    {
    	return view('admin.info');
    }
    /*更改超级管理员密码*/
    public function pass()
    {
        if ($input = Input::all())
        {
            //验证的规则
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];
            //输出错误信息
            $message = [
                'password.required' => '新密码不能为空',
                'password.between' => '新密码必须在6-20位之间',
                'password.confirmed' =>'两次输入密码不一致',
                ];
            //输入，规则，自定义信息
            $validator = Validator::make($input,$rules,$message);

            if ($validator->passes())
            {
                $user = User::first();
                $_password = decrypt($user->user_pass);
                //验证输入的密码
                if ($input['password_o'] == $_password)
                {
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功');;
                }
                else
                {
                    return back()->with('errors','原密码错误');
                }
            }
            else
            {
                return back()->withErrors($validator);
            }
        }
        else
        {
            return view('admin.pass');
        }
        

    }
    //添加
    public function add()
    {
    	return view('admin.add');
    }

}
