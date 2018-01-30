<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

//use App\Http\Requests;
require_once(resource_path().'/org/code/Code.php');

class LoginController extends CommonController
{
    public function login()
    {
        if($input = Input::all()) // Input will get all submitted values in the form
        {
//            if($input['code'] != $res) // first check code match or not
//            {
//                return back()->with('msg','......');// the 'msg' value  will be stored in session
//            }
            $user = User::first();
            if($user->user_name != $input['user_name'] || Crypt::decrypt($user['user_pass']) != $input['user_pass'])
            {
                return back()->with('msg','The username or password does not match!');// the 'msg' value  will be stored in session
            }
            else
            {
                session(['user' => $user]); // store user name and password in session
                return redirect('admin/index');
            }
        }
        else
        {
           // dd($_SERVER);// show many system information
            return view('admin.login');
        }
    }

    public function quit()
    {
        session(['user' => null]);
        return redirect('admin/login');
    }

//    public function code()
//    {
//        $code = new \Code;
//        $code->make();
//    }

}
