<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LinksController extends CommonController
{
    //get. admin/links 全部友情链接分类
    public function index()
    {
        $data = Links::orderBy('link_order', 'asc')->get();
        return view('admin.links.index', compact('data')); // pass data to web page
    }

    public function changeOrder()
    {
        $input = Input::all();
        $links = Links::find($input['link_id']);
        $links->link_order = $input['link_order'];
        $check = $links->update();
        if($check)
        {
            $data = [
                'status' => 0,
                'msg' => 'the links order update successfully!! ',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => 'Fail to update the links order, please try again later!! ',
            ];
        }
        return $data;
    }

    //get. admin/links/create 添加友情链接
    public function create()
    {
        $data=[];
        return view('admin.links.add', compact('data'));
    }

    //post. admin/category  添加友情链接提交
    public function store()
    {
        $input = Input::except('_token'); // 拿到所有数据， 但要把_token值排除在外

        $rules = [
            'link_name'=>'required',
            'link_url'=>'required',

        ];
        $message = [
            'link_name.required' => '友情链接名称不能为空', // 如果违背了这条规则，就报错显示此条信息
            'link_url.required' => '友情链接地址不能为空',
        ];
        $validator = Validator::make($input, $rules, $message);// 引入validator服务，传参：$input=需要验证什么数据, $rules=验证规则
        if($validator->passes()) // if pass then return True
        {
            $re = Links::create($input);//用model Links里面的create方法，将拿到的数据写入数据库
            if($re)// if $re is not empty
            {
                return redirect('admin/links');
            }
            else
            {
                return back()->with('errors', 'Fail to add data into database, please try again later!');
            }
        }
        else
        {
            //dd($validator->errors()->all());//显示具体报错
            return back()->withErrors($validator);
        }
    }

    //get. admin/links/{links}/edit 编辑友情链接
    public function edit($link_id)
    {
        $field = Links::find($link_id);// 在数据库中查询某个特定id的相关数据
        return view('admin.links.edit',compact('field'));
    }

    //put/patch. admin/links/{links} 更新友情链接
    public function update($link_id)
    {
        $input = Input::except('_method', '_token');
        $re = Links::where('link_id',$link_id)->update($input);
        if($re)
        {
            return redirect('admin/links');
        }
        else
        {
            return back()->with('errors','Fail to update data, please try again later! ');
        }
    }

    //delete. admin/links/{links} 删除单个友情链接
    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
        if($re)
        {
            $data = [
                'status' => 0,
                'msg' => 'link delete successfully!',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => 'Fail to delete link, please try again later!',
            ];
        }
        return $data;
    }


    //get. admin/category/{category} 显示单个分类
    public function show()
    {

    }
}
