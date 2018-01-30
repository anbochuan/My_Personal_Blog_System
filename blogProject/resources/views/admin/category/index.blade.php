@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; All Categories
</div>
<!--面包屑导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>Category Management</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>New Category</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>All Categories</a>
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
                    <th>Category Name</th>
                    <th>Title</th>
                    <th>Visited</th>
                    <th>Operation</th>
                </tr>

                @foreach($data as $val)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,{{$val->cate_id}})" value="{{$val['cate_order']}}">
                    </td>
                    <td class="tc">{{$val['cate_id']}}</td>
                    <td>
                        <a href="#">{{$val->_cate_name}}</a>
                    </td>
                    <td>{{$val['cate_title']}}</td>
                    <td>{{$val['cate_view']}}</td>
                    <td>
                        <a href="{{url('admin/category/'.$val->cate_id.'/edit')}}">Edit</a>
                        <a href="javascript:;" onclick="deleteCategory({{$val->cate_id}})" >Delete</a>
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
   function changeOrder(obj, cate_id) {
       var cate_order = $(obj).val();
       $.post("{{url('admin/cate/changeorder')}}", {'_token':'{{csrf_token()}}', 'cate_id':cate_id, 'cate_order':cate_order}, function (data) {
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
   function deleteCategory($cate_id) {
       layer.confirm('Do you really want to delete this category？', {
           btn: ['Yes', 'Cancel'] //按钮
       }, function () {
           $.post("{{url('admin/category/')}}/" + $cate_id, {'_method':'delete', '_token': '{{csrf_token()}}'}, function (data) {
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



