<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>升学派智能填报系统-功能区域</title>
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    <script>
        var _token = "{{ csrf_token() }}";
        var URL = "{{ URL('/') }}";
    </script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
                        <li class="navbar-a-underline"><a href="#">官&nbsp;&nbsp;网&nbsp;&nbsp;首&nbsp;&nbsp;页</a></li>
                        <li class="navbar-a-underline navbar-a-active"><a href="#">功&nbsp;&nbsp;能&nbsp;&nbsp;区&nbsp;&nbsp;域</a></li>
                        <li class="navbar-a-underline"><a href="#">信&nbsp;&nbsp;息&nbsp;&nbsp;修&nbsp;&nbsp;改</a></li>
                        <li class="navbar-a-underline"><a href="#">帮&nbsp;&nbsp;助</a></li>
                        <li class="navbar-a-underline"><a href="#">退&nbsp;&nbsp;出&nbsp;&nbsp;登&nbsp;&nbsp;录</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<hr/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="ul-userinfo">
                <li><img src="{{ URL::asset('images/project/vip.png') }}" width="100%"/></li>
                <li>马楠萍 同学</li>
                <li>全省位次 123456</li>
                <li>理科</li>
                <li>乐山一中</li>
                <li>女</li>
            </ul>
        </div>
    </div>
</div>
<hr/>
<div class="container-fluid">
@yield('main')
</div>
<hr/>
<footer class="sxp-footer">
    <div class="container">
        <ul class="sxp-footer-ul">
            <li><a href="#">官网首页</a></li>
            <li><a href="#">功能区域</a></li>
            <li><a href="#">信息修改</a></li>
            <li><a href="#">帮助</a></li>
        </ul>
        <p>Copyright©shengxuepai.cn 升学派—高考志愿填报专家　版权所有</p>
        <p>蜀ICP备16035197号-1</p>
    </div>
</footer>
<script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/login.js') }}"></script>
@yield('script')
</body>
</html>