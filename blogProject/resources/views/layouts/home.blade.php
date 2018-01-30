<!doctype html>
<html>
<head>
    <meta charset="utf-8">
   @yield('info')
    <link href="{{asset('css/home/base.css')}}" rel="stylesheet">
    <link href="{{asset('css/home/index.css')}}" rel="stylesheet">
    <link href="{{asset('css/home/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/home/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('js/home/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        <a href="index.html"><span>Home</span><span class="en">Protal</span></a>
        <a href="about.html"><span>About me</span><span class="en">About</span></a>
        <a href="https://github.com/anbochuan/"><span>My GitHub</span><span class="en">Life</span></a>
        <a href="https://github.com/anbochuan/"><span>My project</span><span class="en">Doing</span></a>
        <a href="share.html"><span>My life</span><span class="en">Share</span></a>
        <a href="knowledge.html"><span>My interests</span><span class="en">Learn</span></a>
        <a href="book.html"><span>Message</span><span class="en">Gustbook</span></a></nav>
    </nav>
</header>

@yield('content')


<footer>
    <p>Design by Bochuan An <a href="https://github.com/anbochuan" target="_blank">https://github.com/anbochuan</a> <a href="/">网站统计</a></p>
</footer>
<script src="{{asset('js/home/silder.js')}}"></script>
</body>
</html>
