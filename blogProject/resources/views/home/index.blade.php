@extends('layouts.home')
@section('info')
<title>Dumbo's Blog</title>
<meta name="keywords" content="个人博客" />
<meta name="description" content="寻梦主题的个人博客" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
<div class="banner">
    <section class="box">
        <ul class="texts">
            <p>But if you never try</p>
            <p>then you will never know</p>
            <p>just what you are worth...</p>
        </ul>
        <div class="avatar"><a href="#"><span>安伯川</span></a> </div>
    </section>
</div>
<div class="template">
    <div class="box">
        <h3>
            <p><span>My</span> recommendations</p>
        </h3>
        <ul>
            @foreach($hotArticle as $hot)
                <li><a href="{{url('a/'.$hot->art_id)}}"  target="_blank"><img src="{{$hot->art_thumb}}"></a><span>{{url($hot->art_title)}}</span></li>
            @endforeach
            {{--<li><a href="/"  target="_blank"><img src="images/01.jpg"></a><span>仿新浪博客风格·梅——古典个人博客模板</span></li>--}}
            {{--<li><a href="/"  target="_blank"><img src="images/02.jpg"></a><span>黑色质感时间轴html5个人博客模板</span></li>--}}
            {{--<li><a href="/"  target="_blank"><img src="images/03.jpg"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>--}}
        </ul>
    </div>
</div>
<article>
    <h2 class="title_tj">
        <p>New<span>Articles</span></p>
    </h2>
    <div class="bloglist left">
        @foreach($article as $arti)
        <h3>{{$arti->art_title}}</h3>
        <figure><img src="{{$arti->art_thumb}}"></figure>
        <ul>
            <p>{{$arti->art_description}}</p>
            <a title="{{$arti->art_title}}" href="{{url('a/'.$arti->art_id)}}" target="_blank" class="readmore">Read More >></a>
        </ul>
        <p class="dateview"><span>{{date('Y-m-d',$arti->art_time)}}</span><span>Author：{{$arti->art_editor}}</span></p>
        @endforeach
        <div class="page">
            {{$article->links()}}
        </div>
    </div>
    <aside class="right">
        <a href="https://www.accuweather.com/en/ca/montreal/h3a/weather-forecast/56186" class="aw-widget-legal">
            <!--
            By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at https://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at https://www.accuweather.com/en/privacy.
            -->
        </a><div id="awcc1515868268883" class="aw-widget-current"  data-locationkey="56186" data-unit="c" data-language="en-us" data-useip="false" data-uid="awcc1515868268883"></div><script type="text/javascript" src="https://oap.accuweather.com/launch.js"></script>
        {{--<div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>--}}
        <div class="news">
            <h3>
                <p>New<span>Articles: </span></p>
            </h3>
            <ul class="rank">
                @foreach($newArticle as $newArt)
                    <li><a href="{{url('a/'.$newArt->art_id)}}" title="{{$newArt->art_title}}" target="_blank">{{$newArt->art_title}}</a></li>
                @endforeach
            </ul>
            <h3 class="ph">
                <p>Top<span>Ranking: </span></p>
            </h3>
            <ul class="paih">
                @foreach($hotArticle as $hotArt)
                <li><a href="{{url('a/'.$hotArt->art_id)}}" title="{{$hotArt->art_title}}" target="_blank">{{$hotArt->art_title}}</a></li>
                @endforeach
            </ul>
            <h3 class="links">
                <p>Popular<span>Links: </span></p>
            </h3>
            <ul class="website">
                @foreach($links as $link)
                <li><a href="{{url($link->link_url)}}">{{$link->link_name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-1">
            <a href="#" ><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
            <a href="#" ><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a>
            <a href="#" ><i class="fa fa-github fa-3x" aria-hidden="true"></i></a>
            <a href="#" ><i class="fa fa-stack-overflow fa-3x" aria-hidden="true"></i></a>
            <a href="#" ><i class="fa fa-slack fa-3x" aria-hidden="true"></i></a>
            <a href="#" ><i class="fa fa-weixin fa-3x" aria-hidden="true"></i></a>

        </div>
        <div class="col-md-2">
            <img src="/images/qrCode.jpg" width="200" height="200">
        </div>
        <!-- Baidu Button BEGIN -->
        {{--<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>--}}
        {{--<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>--}}
        {{--<script type="text/javascript" id="bdshell_js"></script>--}}
        {{--<script type="text/javascript">--}}
            {{--document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)--}}
        {{--</script>--}}
        <!-- Baidu Button END -->
    </aside>
</article>
@endsection



