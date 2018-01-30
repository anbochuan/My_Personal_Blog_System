@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Links Management
</div>
<!--面包屑导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>All Links List</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>New Link</a>
                <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>All Links</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">Order</th>
                    <th class="tc" width="5%">ID</th>
                    <th>Link Name</th>
                    <th>Link Title</th>
                    <th>Link Url</th>
                    <th>Operation</th>
                </tr>

                @foreach($data as $val)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,{{$val->link_id}})" value="{{$val['link_order']}}">
                    </td>
                    <td class="tc">{{$val['link_id']}}</td>
                    <td>
                        <a href="#">{{$val->link_name}}</a>
                    </td>
                    <td>{{$val['link_title']}}</td>
                    <td>{{$val['link_url']}}</td>
                    <td>
                        <a href="{{url('admin/links/'.$val->link_id.'/edit')}}">Edit</a>
                        <a href="javascript:;" onclick="deleteCategory({{$val->link_id}})" >Cancel</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

{{--JQuery Ajax 负责异步发送数据--}}
<script>
   function changeOrder(obj, link_id) {
       var link_order = $(obj).val();
       $.post("{{url('admin/links/changeorder')}}", {'_token':'{{csrf_token()}}', 'link_id':link_id, 'link_order':link_order}, function (data) {
           // url, 参数，回调函数(返回的数据用data来接收)接收来自CategoryController控制器里面changeOrder方法return回来的$data数据
           if(data.status == 0)
           {
               layer.msg(data.msg, {icon: 6});
           }
           else
           {
               layer.msg(data.msg, {icon: 5});
           }


       });

   }
// 删除分类前，弹出alert box
   function deleteCategory($link_id) {
       layer.confirm('Do you really want to delete this link？', {
           btn: ['Yes', 'Cancel'] //按钮
       }, function () {
           $.post("{{url('admin/links/')}}/" + $link_id, {'_method':'delete', '_token': '{{csrf_token()}}'}, function (data) {
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
@endsection



