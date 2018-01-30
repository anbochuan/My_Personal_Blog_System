@extends('layouts.admin')
@section('content')
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">Blog Back-end UI</div>
			<ul>
				<li><a href="#" class="active">Home</a></li>
				<li><a href="#">Management</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>Administrator Account：admin</li>
				<li><a href="{{url('admin/pass')}}" target="main">Change Password</a></li>
				<li><a href="{{url('admin/quit')}}">Logout</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>Tools</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/category/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>New Category</a></li>
					<li><a href="{{url('admin/category')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>All Category</a></li>
					<li><a href="{{url('admin/article/create')}}" target="main"><i class="fa fa-plus"></i>New Article</a></li>
					<li><a href="{{url('admin/article')}}" target="main"><i class="fa fa-recycle"></i>All Articles</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-cog"></i>System setting</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/links')}}" target="main"><i class="fa fa-fw fa-cubes"></i>Links</a></li>
					{{--<li><a href="#" target="main"><i class="fa fa-fw fa-database"></i>Backup restore</a></li>--}}
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-thumb-tack"></i>Navigation</h3>
				<ul class="sub_menu">
					<li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>
					<li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
					<li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
					<li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2018. Powered By <a href="https://github.com/anbochuan">https://github.com/anbochuan</a>.
	</div>
	<!--底部 结束-->
@endsection


