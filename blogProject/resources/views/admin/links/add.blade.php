@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a>  &raquo; Links Management
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>Add New Links</h3>
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
            <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>New Links</a>
            <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>All Links</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    {{--提交到路由 admin/links/create--}}
    <form action="{{url('admin/links')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>Link Name：</th>
                <td>
                    <input type="text" name="link_name">
                    <span><i class="fa fa-exclamation-circle yellow"></i>Required</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>URL：</th>
                <td>
                    <input type="text" class="lg" name="link_url" value="http://">
                </td>
            </tr>
            <tr>
                <th>Link Title：</th>
                <td>
                    <input type="text" class="lg" name="link_title">
                    <p>Maximum 30 words</p>
                </td>
            </tr>
            <tr>
                <th>Order：</th>
                <td>
                    <input type="text" class="sm" name="link_order" value="0">
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
