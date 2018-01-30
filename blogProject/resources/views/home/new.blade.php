@extends('layouts.home')
@section('info')
  {{--title 需要修改 要加数据库传参--}}
<title>{{$field->art_title}}</title>
<meta name="keywords" content="{{$field->art_tag}}" />
<meta name="description" content="{{$field->art_description}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
<article class="blogs">
  <h1 class="t_nav">
    <span>Current Location：<a href="{{url('/')}}">Home</a> >> <a href="{{url('cate/'.$field->cate_id)}}">{{$field->cate_name}}</a></span>
    <a href="{{url('/')}}" class="n1">Home</a><a href="{{url('cate/'.$field->cate_id)}}" class="n2">{{$field->cate_name}}</a>
  </h1>
  <div class="index_about">
    <h2 class="c_titile">{{$field->art_title}}</h2>
    <p class="box_c"><span class="d_time">Publish date：{{date('Y-m-d', $field->art_time)}}</span><span>Author：{{$field->art_editor}}</span><span>View：{{$field->art_view}}</span></p>
    <ul class="infos">
      {{--使用 {!!  !!}可以避免把 html tag 显示在页面中--}}
      {!! $field->art_content !!}
      <label><img src="/{{$field->art_thumb}}" style="max-width: 640px; max-height: 480px;"></label>
    </ul>
    <div class="keybq">
      <p><span>Keywords</span>：{{$field->art_tag}}</p>

    </div>
    <div class="ad"> </div>
    <div class="nextinfo">
      <p>Previous Article：
      @if($article['pre'])
        <a href="{{url('a/'.$article['pre']->art_id)}}">{{$article['pre']->art_title}}</a></p>
      @else
        <span>The begin</span>
      @endif
      <p>Next Article:
      @if($article['next'])
        <a href="{{url('a/'.$article['next']->art_id)}}">{{$article['next']->art_title}}</a></p>
      @else
        <span>The end</span>
      @endif

    </div>
    <div class="otherlink">
      <h2>Related Article:</h2>
      <ul>
        @foreach($data as $d)
        <li><a href="{{url('a/'.$d->art_id)}}" title="{{$d->art_title}}">{{$d->art_title}}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
  <aside class="right">
    {{--<!-- Baidu Button BEGIN -->--}}
    {{--<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>--}}
    {{--<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>--}}
    {{--<script type="text/javascript" id="bdshell_js"></script>--}}
    {{--<script type="text/javascript">--}}
        {{--document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)--}}
    {{--</script>--}}
    {{--<!-- Baidu Button END -->--}}
    <div class="blank"></div>
    <div class="news">
      <a href="https://www.accuweather.com/en/ca/montreal/h3a/weather-forecast/56186" class="aw-widget-legal">
        <!--
        By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at https://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at https://www.accuweather.com/en/privacy.
        -->
      </a><div id="awcc1515868268883" class="aw-widget-current"  data-locationkey="56186" data-unit="c" data-language="en-us" data-useip="false" data-uid="awcc1515868268883"></div><script type="text/javascript" src="https://oap.accuweather.com/launch.js"></script>
      <h3>
        <p>New<span>Articles</span></p>
      </h3>
      <ul class="rank">
        @foreach($newArticle as $newArt)
          <li><a href="{{url('a/'.$newArt->art_id)}}" title="{{$newArt->art_title}}" target="_blank">{{$newArt->art_title}}</a></li>
        @endforeach
      </ul>
      <h3 class="ph">
        <p>Top<span>Ranking</span></p>
      </h3>
      <ul class="paih">
        @foreach($hotArticle as $hotArt)
          <li><a href="{{url('a/'.$hotArt->art_id)}}" title="{{$hotArt->art_title}}" target="_blank">{{$hotArt->art_title}}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="visitors">
      <h3>
        <p>Visitors:</p>
      </h3>
      <ul>
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
      </ul>
    </div>
  </aside>
</article>
@endsection


