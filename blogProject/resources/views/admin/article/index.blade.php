@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Article Management</a>
</div>
<!--面包屑导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_title">
            <h3>All Articles</h3>
            {{--@if(count($errors)>0)--}}
            {{--<div class="mark">--}}
            {{--@if(is_object($errors))--}}
            {{--@foreach($errors->all() as $error)--}}
            {{--<p>{{$error}}</p>--}}
            {{--@endforeach--}}
            {{--@else--}}
            {{--<p>{{$errors}}</p>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--@endif--}}
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>New Article</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>All Articles</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>Title</th>
                    <th>Visited</th>
                    <th>Editor</th>
                    <th>Publish Date</th>
                    <th>Operation</th>
                </tr>
                @foreach($data as $val)
                <tr>
                    <td class="tc">{{$val->art_id}}</td>
                    <td>
                        <a href="#">{{$val->art_title}}</a>
                    </td>
                    <td>{{$val->art_view}}</td>
                    <td>{{$val->art_editor}}</td>
                    <td>{{date('Y-m-d', $val->art_time)}}</td>
                    <td>
                        <a href="{{url('admin/article/'.$val->art_id.'/edit')}}">Edit</a>
                        <a href="javascript:;" onclick="deleteArticle({{$val->art_id}})" >Delete</a>
                    </td>
                </tr>
                @endforeach

            </table>
            <div class="page_list">
                {{--数据库分页显示--}}
                {{$data->links()}}
            </div>
        </div>
    </div>
</form>
<style>
    .result_content ul li span{
        font-size:15px;
        padding: 6px 12px;
    }
</style>
<script>
    // 删除文章前，弹出alert box
    function deleteArticle($art_id) {
        layer.confirm('Do you really want to delete this article？', {
            btn: ['Yes', 'Cancel'] //按钮
        }, function () {
            $.post("{{url('admin/article/')}}/" + $art_id, {'_method':'delete', '_token': '{{csrf_token()}}'}, function (data) {
                // url, 参数，回调函数(返回的数据用data来接收)接收来自CategoryController控制器里面changeOrder方法return回来的$data数据
                if(data.status == 0)
                {
                    location.href = location.href; //让javascript刷新当前页面
                    layer.msg(data.msg, {icon: 6});
                }
                else
                {
                    layer.msg(data.msg, {icon: 5});
                }
            });

        })
    }
</script>
<!--搜索结果页面 列表 结束-->
@endsection





