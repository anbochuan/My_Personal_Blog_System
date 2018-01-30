@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a>  &raquo; Edit Article Categories
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
    <form action="{{url('admin/category/'.$field->cate_id)}}" method="post">
        {{--提交方法使用 put--}}
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>Parent_Category：</th>
                <td>
                    <select name="cate_pid">
                        <option value="0">==Top Categories==</option>
                        @foreach($data as $val)
                            <option value="{{$val->cate_id}}"
                                    @if($val->cate_id == $field->cate_pid)
                                        selected
                                    @endif
                            >{{$val->cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>Category Name：</th>
                <td>
                    <input type="text" name="cate_name" value="{{$field->cate_name}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>Required</span>
                </td>
            </tr>
            <tr>
                <th>Category Title：</th>
                <td>
                    <input type="text" class="lg" name="cate_title" value="{{$field->cate_title}}">
                    <p>Maximum 30 words</p>
                </td>
            </tr>
            <tr>
                <th>Key words：</th>
                <td>
                    <textarea name="cate_keywords">{{$field->cate_keywords}}</textarea>
                </td>
            </tr>
            <tr>
                <th>Description：</th>
                <td>
                    <textarea name="cate_description">{{$field->cate_description}}</textarea>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>Order：</th>
                <td>
                    <input type="text" class="sm" name="cate_order" value="{{$field->cate_order}}">
                    {{--<span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>--}}
                </td>
            </tr>
            {{--<tr>--}}
                {{--<th><i class="require">*</i>缩略图：</th>--}}
                {{--<td><input type="file" name=""></td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th>单选框：</th>--}}
                {{--<td>--}}
                    {{--<label for=""><input type="radio" name="">单选按钮一</label>--}}
                    {{--<label for=""><input type="radio" name="">单选按钮二</label>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th>复选框：</th>--}}
                {{--<td>--}}
                    {{--<label for=""><input type="checkbox" name="">复选框一</label>--}}
                    {{--<label for=""><input type="checkbox" name="">复选框二</label>--}}
                {{--</td>--}}
            {{--</tr>--}}

            {{--<tr>--}}
                {{--<th>详细内容：</th>--}}
                {{--<td>--}}
                    {{--<textarea class="lg" name="content"></textarea>--}}
                    {{--<p>标题可以写30个字</p>--}}
                {{--</td>--}}
            {{--</tr>--}}
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
