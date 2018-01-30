<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');// assign a template
    }
    public function info()
    {
        return view('admin.info');// assign a template

    }
    // 更改超级管理员密码
    public function pass()
    {
        if($input = Input::all())
        {
            $rules = [
                'password'=>'required|between:6,20|confirmed',

            ];
            $message = [
                'password.required' => '新密码不能为空', // 如果违背了这条规则，就报错显示此条信息
                'password.between' => '新密码必须在6-20位之间',
            ];
            $validator = Validator::make($input, $rules, $message);// 引入validator服务，传参：$input=需要验证什么数据, $rules=验证规则
            if($validator->passes()) // if pass then return True
            {
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if($input['password_o']==$_password)
                {
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors', 'password reset successfully!');
                }
                else
                {
                    return back()->with('errors', 'the original password is not correct!');//传一个errors变量，里面装一个字符串''
                }
            }
            else
            {
                //dd($validator->errors()->all());//显示具体报错
                return back()->withErrors($validator);
            }
        }
        else
        {
            return view('admin.pass');// assign a template
        }


    }
}
