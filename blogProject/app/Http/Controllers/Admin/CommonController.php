<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传 any. upload 'CommonController@upload'
    public function upload()
    {
        if (Input::hasFile('file')) {
//            $input = Input::file('file');
//            dd($input);

//            echo 'Uploaded';
            $file = Input::file('file');
            //$realPath = $file -> getRealPath(); // 表示缓存在temp文件夹下的临时文件的绝对路径
            $extension = $file -> getClientOriginalExtension(); // 拿到上传文件的后缀
            $newName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $path = $file -> move(base_path().'/public/images/uploads', $newName); //文件移动并重命名
            $filePath = 'images/uploads/'.$newName;
            return $filePath;
//            $file->move('uploads', $file->getClientOriginalName());
//            echo '<img src="/uploads/'. $file->getClientOriginalName() .'" />';
        }
    }
}



