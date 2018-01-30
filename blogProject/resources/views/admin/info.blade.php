@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; System Information
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>Quick Tools</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>Add Article</a>
                <a href="#"><i class="fa fa-recycle"></i>Delete</a>
                <a href="#"><i class="fa fa-refresh"></i>Sort</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->


    <div class="result_wrap">
        <div class="result_title">
            <h3>System Information</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>Operating System</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>Operating Environment</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>
                <li>
                    <label>PHP Mode</label><span>apache2handler</span>
                </li>
                <li>
                    <label>Version</label><span>v-1.0</span>
                </li>
                <li>
                    <label>Upload Size Limitation</label><span><?php echo get_cfg_var('upload_max_filesize')? get_cfg_var('upload_max_filesize'): "too large to upload";?></span>
                </li>
                <li>
                    <label>Local Time</label><span><?php echo date('Y/m/d H:i:s') ?></span>
                </li>
                <li>
                    <label>Domain/IP</label><span>{{$_SERVER['HTTP_HOST']}} [{{$_SERVER['REMOTE_ADDR']}}]</span>
                </li>
                <li>
                    <label>Host</label><span>{{$_SERVER['REMOTE_ADDR']}}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>Need Help</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>Documentations：</label><span><a href="https://github.com/anbochuan">https://github.com/anbochuan</a></span>
                </li>
                {{--<li>--}}
                    {{--<label>官方交流QQ群：</label><span><a href="#"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png"></a></span>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
    <!--结果集列表组件 结束-->
@endsection


