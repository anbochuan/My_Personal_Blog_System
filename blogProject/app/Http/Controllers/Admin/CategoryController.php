<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CategoryController extends CommonController
{
    //get. admin/category 全部分类列表
    public function index()
    {
        $obj = new Category;
        $categorys = $obj->tree();// get data from DB
//        $data = $this->getTree($categorys, 'cate_name', 'cate_id', 'cate_pid', 0);
        return view('admin.category.index')->with('data', $categorys); // pass data to web page
    }

    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $check = $cate->update();
        if($check)
        {
            $data = [
                'status' => 0,
                'msg' => 'the category order update successfully!! ',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => 'Fail to update the category order, please try again later!! ',
            ];
        }
        return $data;
    }


    //get. admin/category/create 添加分类
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add', compact('data'));
    }

    //post. admin/category  添加分类提交
    public function store()
    {
        $input = Input::except('_token'); // 拿到所有数据， 但要把_token值排除在外

        $rules = [
            'cate_name'=>'required',

        ];
        $message = [
            'cate_name.required' => '分类名称不能为空', // 如果违背了这条规则，就报错显示此条信息
        ];
        $validator = Validator::make($input, $rules, $message);// 引入validator服务，传参：$input=需要验证什么数据, $rules=验证规则
        if($validator->passes()) // if pass then return True
        {
            $re = Category::create($input);//用model Category里面的create方法，将拿到的数据写入数据库
            if($re)// if $re is not empty
            {
                return redirect('admin/category');
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

    //get. admin/category/{category}/edit 编辑分类
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);// 在数据库中查询某个特定id的相关数据
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
    }

    //put/patch. admin/category/{category} 更新分类
    public function update($cate_id)
    {
        $input = Input::except('_method', '_token');
        $re = Category::where('cate_id',$cate_id)->update($input);
        if($re)
        {
            return redirect('admin/category');
        }
        else
        {
            return back()->with('errors','Fail to update data, please try again later! ');
        }
    }

    //delete. admin/category/{category} 删除单个分类
    public function destroy($cate_id)
    {
        $re = Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid', $cate_id)->update(['cate_pid'=>0]);
        if($re)
        {
            $data = [
                'status' => 0,
                'msg' => 'category delete successfully!',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => 'Fail to delete category, please try again later!',
            ];
        }
        return $data;
    }

    //get. admin/category/{category} 显示单个分类
    public function show()
    {

    }







}
