@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a>  &raquo; Article Management
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>Add new article</h3>
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
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>New Article</a>
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>All Articles</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/article')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120">Category：</th>
                <td>
                    <select name="cate_id">
                        @foreach($data as $val)
                        <option value="{{$val->cate_id}}">{{$val->_cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr>--}}
                {{--<th><i class="require">*</i>分类名称：</th>--}}
                {{--<td>--}}
                    {{--<input type="text" name="cate_name">--}}
                    {{--<span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>--}}
                {{--</td>--}}
            {{--</tr>--}}
            <tr>
                <th><i class="require">*</i> Title：</th>
                <td>
                    <input type="text" class="lg" name="art_title">
                    <p>Maximum 30 words</p>
                </td>
            </tr>
            <tr>
                <th>Editor：</th>
                <td>
                    <input type="text" class="sm" name="art_editor">
                    {{--<span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>--}}
                </td>
            </tr>
            <tr>
                <th>Image：</th>
                <td>
                    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}
                    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />--}}
                    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

                    {{--<form action="{{url('admin/upload')}}" method="post" enctype="multipart/form-data">--}}
                        <label>Please select image to upload:</label>
                        <input type="text" size="50" name="art_thumb">
                        <input type="file" name="file" id="file">
                        {{--<input type="submit" value="Upload" name="submit">--}}
                        {{--<span id="uploaded_image"></span>--}}
                        {{--<input type="hidden" value="{{ csrf_token() }}" name="_token">--}}
                    {{--</form>--}}
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $(document).on('change', '#file', function(){
                                $.ajaxSetup({
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                                });

                                var property = document.getElementById("file").files[0];
                                var image_name = property.name;
                                var image_extension = image_name.split('.').pop().toLowerCase();
                                if(jQuery.inArray(image_extension, ['gif','png','jpg','jpeg']) == -1)
                                {
                                    alert("Invalid Image File");
                                }
                                var image_size = property.size;
                                if(image_size > 2000000)
                                {
                                    alert("Image File Size is very big");
                                }
                                else
                                {
                                    var form_data = new FormData();
                                    form_data.append("file", property);
                                    $.ajax({
                                        url:"{{url('admin/upload')}}",
                                        type:"POST",
                                        data: form_data,
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        beforeSend:function(){
                                            $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                                        },
                                        success:function(data)
                                        {
                                            $('input[name=art_thumb]').val(data);
//                                            $('#uploaded_image').html(data);
                                            $('#art_thumb_img').attr('src','/'+data);
                                        }
                                    });
                                }
                            });
                        });

                        {{--$(document).bind('pageinit', function(){--}}
                            {{--//照片异步上传--}}
                            {{--$('#id_photos').change(function(){--}}
                                {{--$.ajaxSetup({--}}
                                {{--headers: {--}}
                                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                                {{--}--}}
                                {{--});--}}
                                {{--//此处用了change事件，当选择好图片打开，关闭窗口时触发此事件--}}
                                {{--$.ajaxFileUpload({--}}
                                    {{--url:"{{url('admin/upload')}}",   //处理图片的脚本路径--}}
                                    {{--type: 'post',       //提交的方式--}}
                                    {{--secureuri :false,   //是否启用安全提交--}}
                                    {{--fileElementId :'id_photos',     //file控件ID--}}
                                    {{--dataType : 'json',  //服务器返回的数据类型--}}
                                    {{--data : { url : url,--}}
                                             {{--keyword: keyword,--}}
                                             {{--rule: rule,--}}
                                             {{--data: data,--}}
                                             {{--sign: sign },--}}
                                    {{--success : function (data, status){  //提交成功后自动执行的处理函数--}}
{{--//                                        if(1 != data.total) return;　　 //因为此处指允许上传单张图片，所以数量如果不是1，那就是有错误了--}}
                                        {{--var url = data.files[0].path;--}}
                                        {{--$('.art_thumb').empty();--}}
                                        {{--//此处效果是：当成功上传后会返回一个json数据，里面有url，取出url赋给img标签，然后追加到.id_photos类里显示出图片--}}
                                        {{--$('.art_thumb').append('<img src="'+url+'" value="'+url+'" style="width:80%" >');--}}
                                        {{--//$('.upload-box').remove();--}}
                                    {{--},--}}
                                    {{--error: function(data, status, e){   //提交失败自动执行的处理函数--}}
                                        {{--alert(e);--}}
                                    {{--}--}}
                                {{--})--}}
                            {{--});--}}
                            {{--});--}}


                        {{--$(document).ready(function() {--}}
                            {{--//照片异步上传--}}
                            {{--$('#id_photos').change(function () {  //此处用了change事件，当选择好图片打开，关闭窗口时触发此事件--}}
                                {{--$.ajaxSetup({--}}
                                {{--headers: {--}}
                                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                                {{--}--}}
                            {{--});--}}

                                {{--$.ajaxFileUpload({--}}
                                    {{--url: "{{url('admin/upload')}}",   //处理图片的脚本路径--}}
                                    {{--type: 'post',       //提交的方式--}}
                                    {{--secureuri: false,   //是否启用安全提交--}}
                                    {{--fileElementId: 'id_photos',     //file控件ID--}}
                                    {{--dataType: 'json',  //服务器返回的数据类型--}}
                                    {{--data : { 'art_thumb' : $('#id_photos').val() },--}}
                                    {{--success: function (data, status) {  //提交成功后自动执行的处理函数--}}
                                        {{--if (1 != data.total) return;　　 //因为此处指允许上传单张图片，所以数量如果不是1，那就是有错误了--}}
                                        {{--var url = data.files[0].path;--}}
                                        {{--$('.art_thumb_img').empty();--}}
                                        {{--//此处效果是：当成功上传后会返回一个json数据，里面有url，取出url赋给img标签，然后追加到.id_photos类里显示出图片--}}
                                        {{--$('.art_thumb_img').append('<img src="' + url + '" value="' + url + '" style="width:80%" >');--}}
                                    {{--},--}}
                                    {{--error: function (data, status, e) {   //提交失败自动执行的处理函数--}}
                                        {{--alert(e);--}}
                                    {{--}--}}
                                {{--});--}}
                            {{--});--}}
                        {{--});--}}

                    </script>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height: 100px;">
                </td>
            </tr>
            <tr>
                <th>Key words：</th>
                <td>
                    <input type="text" class="lg" name="art_tag">
                </td>
            </tr>
            <tr>
                <th>Description：</th>
                <td>
                    <textarea name="art_description"></textarea>
                </td>
            </tr>

            <tr>
                <th>Content：</th>
                <td>
                    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"></script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                    <script id="editor" name="art_content" type="text/plain" style="width:860px;height:400px;"></script>
                    <script type="text/javascript">
                    //实例化编辑器
                        var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height: 22px;}
                    </style>
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
