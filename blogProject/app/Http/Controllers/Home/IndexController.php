<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{
    public function index()
    {
        //读取点击率最高的6篇文章
        $hotArticle = Article::orderBy('art_view','desc')->take(6)->get();

        //图文列表 分页效果
        $article = Article::orderBy('art_time','desc')->paginate(5);

        //最新发布文章8篇
        $newArticle = Article::orderBy('art_time','desc')->take(8)->get();
        //友情链接
        $links = Links::orderBy('link_order', 'asc')->get();
        //网站配置项

      return view('home.index', compact('hotArticle','article', 'newArticle', 'links'));
    }

    public function cate($cate_id)
    {
        // 查看次数自增
        Category::where('cate_id',$cate_id)->increment('cate_view');
        //读取点击率最高的6篇文章
        $hotArticle = Article::orderBy('art_view','desc')->take(6)->get();
        $field = Category::find($cate_id);
        //图文列表 分页效果
        $article = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(2);
        //dd($article);
        //最新发布文章8篇
        $newArticle = Article::orderBy('art_time','desc')->take(8)->get();
        $submenu = Category::where('cate_pid',$cate_id)->get();
        return view('home.list',compact('hotArticle','field','article', 'submenu', 'newArticle'));
    }

    // Route::get('/a/{art_id}',
    public function article($art_id)
    {
        $field = Article::Join('category','article.cate_id', '=','category.cate_id')->where('art_id', $art_id)->first();
        //读取点击率最高的6篇文章
        $hotArticle = Article::orderBy('art_view','desc')->take(6)->get();
        //最新发布文章8篇
        $newArticle = Article::orderBy('art_time','desc')->take(8)->get();
        $article['pre'] = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        // 查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');
        $data = Article::where('cate_id',$field->cate_id)->orderBy('art_id','desc')->take(6)->get();

        return view('home.new', compact('field','article', 'data', 'hotArticle', 'newArticle'));
    }


}
