<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ArticleController extends CommonController
{
    //get. admin/article  全部文章列表
    public function index()
    {
       $data = Article::orderBy('art_id', 'desc')->paginate(3);
       return view('admin.article.index', compact('data'));
    }

    //get. admin/article/create 添加文章
    public function create()
    {
        $obj = new Category;
        $categorys = $obj->tree();// get data from DB
        $data = $categorys;
        return view('admin.article.add', compact('data'));
    }

    //post. admin/article  添加文章提交
    public function store()
    {
        $input = Input::except('_token','file');
        $input['art_time'] = time();
        $rules = [
            'art_title'=>'required',
            'art_content'=>'required',

        ];
        $message = [
            'art_title.required' => '文章标题不能为空', // 如果违背了这条规则，就报错显示此条信息
            'art_content.required' => '文章内容不能为空'
        ];
        $validator = Validator::make($input, $rules, $message);// 引入validator服务，传参：$input=需要验证什么数据, $rules=验证规则
        if($validator->passes()) // if pass then return True
        {
            $re = Article::create($input);
            if ($re)// if $re is not empty
            {
                return redirect('admin/article');
            } else
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

    //get. admin/article/{article}/edit 编辑文章
    public function edit($art_id)
    {
        $obj = new Category;
        $categorys = $obj->tree();// get data from DB
        $data = $categorys;
        $field = Article::find($art_id); // 在数据库中查询某个特定id的相关数据
        return view('admin.article.edit', compact('data', 'field'));
    }

    //put/patch. admin/article/{artitcle} 更新文章
    public function update($art_id)
    {
        $input = Input::except('_method', '_token', 'file');
        $input['art_time'] = time();
        $re = Article::where('art_id', $art_id)->update($input);
        if($re)
        {
            return redirect('admin/article');
        }
        else
        {
            return back()->with('errors','Fail to update data, please try again later! ');
        }
    }

    //delete. admin/article/{article} 删除单个文章
    public function destroy($art_id)
    {
        $re = Article::where('art_id',$art_id)->delete();
        if($re)
        {
            $data = [
                'status' => 0,
                'msg' => 'article delete successfully!',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => 'Fail to delete article, please try again later!',
            ];
        }
        return $data;
    }
}
