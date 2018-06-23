<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link rel="shortcut  icon" type="image/x-icon" href="{{ URL::asset('images/project/log.png') }}" media="screen"  />
    <script>
        var _token = "{{ csrf_token() }}";
        var URL = "{{ URL('/') }}";
    </script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img alt="升学派智能填报系统" height="100%" src="{{ URL::asset('images/project/log.png') }}">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="navbar-a-underline"><a href="http://www.shengxuepai.cn">官网首页</a></li>
                        <li class="navbar-a-underline @if(isset($menu) && $menu == 'function_list')navbar-a-active @endif"><a href="{{ URL('functions') }}">功能区域</a></li>
                        @yield('navbar')
                        <li class="navbar-a-underline @if(isset($menu) && $menu == 'change_info')navbar-a-active @endif"><a href="{{ URL('change_info') }}">信息修改</a></li>
                        <li class="navbar-a-underline"><a href="#">帮助</a></li>
                        <li class="navbar-a-underline"><a href="{{ URL('logout') }}">退出登录</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<hr/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="ul-userinfo">
                <li>
                    <img data-toggle="tooltip"  src="{{ URL::asset('images/project/vip.png') }}" width="100%"/>
                    <div class="tooltip fade top in" role="tooltip" style="top: -33px; left: -4px; display: block;z-index:2">
                        <div class="tooltip-arrow" style="left: 50%;"></div>
                        <div class="tooltip-inner">有效期至：20{{ Session::get('time_limit') }}年8月31日</div>
                    </div>
                </li>
                <li>{{ Session::get('name') }} 同学</li>
                <li>全省位次 {{ Session::get('rank') }}</li>
                <li>{{ Session::get('classify') }}</li>
                <li>{{ Session::get('school') }}</li>
                <li>{{ Session::get('sex') }}</li>
            </ul>
        </div>
    </div>
</div>
<hr/>
<div class="container-fluid">
@yield('main')
</div>
@yield('modal')
<hr/>
<footer class="sxp-footer">
    <div class="container">
        <ul class="sxp-footer-ul">
            <li><a href="#">官网首页</a></li>
            <li><a href="{{ URL('test/function_list') }}">功能区域</a></li>
            <li><a href="{{ URL('test/change_info') }}">信息修改</a></li>
            <li><a href="#">帮助</a></li>
        </ul>
        <p>Copyright©shengxuepai.cn 升学派—高考志愿填报专家　版权所有</p>
        <p>蜀ICP备16035197号-1</p>
    </div>
</footer>
<script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/app.js') }}"></script>
<script src="{{ URL::asset('js/jquery-ui.js') }}"></script>
<script src="{{ URL::asset('js/multiLineTable.js') }}"></script>
@yield('script')
</body>
</html>