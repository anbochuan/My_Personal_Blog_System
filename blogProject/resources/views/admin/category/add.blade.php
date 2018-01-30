@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a>  &raquo; New Article Category
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>Quick Tools</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>New Category</a>
            <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>All Categories</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/category')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>Parent_Category：</th>
                <td>
                    <select name="cate_pid">
                        <option value="0">==Top Categories==</option>
                        @foreach($data as $val)
                        <option value="{{$val->cate_id}}">{{$val->cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>Category Name：</th>
                <td>
                    <input type="text" name="cate_name">
                    <span><i class="fa fa-exclamation-circle yellow"></i>Required</span>
                </td>
            </tr>
            <tr>
                <th>Category Title：</th>
                <td>
                    <input type="text" class="lg" name="cate_title">
                    <p>Maximum 30 words</p>
                </td>
            </tr>
            <tr>
                <th>Key words：</th>
                <td>
                    <textarea name="cate_keywords"></textarea>
                </td>
            </tr>
            <tr>
                <th>Description：</th>
                <td>
                    <textarea name="cate_description"></textarea>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>Order：</th>
                <td>
                    <input type="text" class="sm" name="cate_order">
                    {{--<span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>--}}
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input type="submit" value="Submit">
                    <input type="button" class="back" onclick="history.go(-1)" value="Cancel">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection
