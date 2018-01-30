<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/admin.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin/fonts/font-awesome.min.css')}}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>Welcome to my Blog Admin System</h2>
		<div class="form">
			@if(session('msg'))
			<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
						<input type="text" name="user_name" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="user_pass" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					{{--<li>--}}
						{{--<input type="text" class="code" name="code"/>--}}
						{{--<span><i class="fa fa-check-square-o"></i></span>--}}
						{{--<img src="{{url('admin/code')}}" alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random() ">--}}
					{{--</li>--}}
					<li>
						<input type="submit" value="Login"/>
					</li>
				</ul>
			</form>
			<p><a href="http://127.0.0.1:8000">Back to Home</a> &copy 2018 Powered by Bochuan An <a href="https://github.com/anbochuan" target="_blank">https://github.com/anbochuan</a></p>
		</div>
	</div>
</body>
</html>