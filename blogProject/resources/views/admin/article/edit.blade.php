@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a>  &raquo Article Management
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>Edit Article</h3>
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
    <form action="{{url('admin/article/'.$field->art_id)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120">Category：</th>
                <td>
                    <select name="cate_id">
                        @foreach($data as $val)
                        <option value="{{$val->cate_id}}"
                            @if($field->cate_id == $val->cate_id)
                                selected
                            @endif
                        >{{$val->_cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i> Title：</th>
                <td>
                    <input type="text" class="lg" name="art_title" value="{{$field->art_title}}">
                    <p>Maximum 30 words</p>
                </td>
            </tr>
            <tr>
                <th>Editor：</th>
                <td>
                    <input type="text" class="sm" name="art_editor" value="{{$field->art_editor}}">
                    {{--<span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>--}}
                </td>
            </tr>
            <tr>
                <th>Image：</th>
                <td>
                    <label>Please select image to upload:</label>
                    <input type="text" size="50" name="art_thumb" value="{{$field->art_thumb}}">
                    <input type="file" name="file" id="file">
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
                    </script>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <img src="/{{$field->art_thumb}}" alt="" id="art_thumb_img" style="max-width: 350px; max-height: 100px;">
                </td>
            </tr>
            <tr>
                <th>Key words：</th>
                <td>
                    <input type="text" class="lg" name="art_tag" value="{{$field->art_tag}}">
                </td>
            </tr>
            <tr>
                <th>Description：</th>
                <td>
                    <textarea name="art_description">{{$field->art_description}}</textarea>
                </td>
            </tr>

            <tr>
                <th>Content：</th>
                <td>
                    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                    <script type="text/plain" id="editor" name="art_content" style="width:860px; height:400px;">{!! $field->art_content !!}</script>
                    <script type="text/javascript">
                    //实例化编辑器
                        var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui.splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height: 22px;}
                    </style>
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
