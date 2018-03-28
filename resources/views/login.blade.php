<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录</title>
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    <script>
        var  _token = "{{ csrf_token() }}";
        var URL = "{{ URL('/') }}";
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2  border-shadow-left border-shadow-top" style="margin-top: 100px">
            <div class="row">
                <div class="col-sm-6">
                    <img src="{{ URL::asset('images/project/login_back_a.png') }}"/>
                    <p class="text-center" style="margin-top: 50px;"><img src="{{ URL::asset('images/project/login_title.png') }}"/></p>
                    <form class="form-horizontal" style="margin-top: 50px">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 col-sm-offset-2 control-label">账号</label>
                            <div class="col-sm-5">
                                <input type="text" id="username" class="form-control" value="" placeholder="请输入账号"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 col-sm-offset-2 control-label">密码</label>
                            <div class="col-sm-5">
                                <input type="password" id="password" class="form-control" value="" placeholder="请输入密码"/>
                            </div>
                        </div>
                        <p class="text-center" style="margin: 50px"><button type="button" class="btn btn-sxp" id="signIn">登&nbsp;&nbsp;&nbsp;&nbsp;录</button></p>
                    </form>
                    <hr/>
                    <p class="text-center"><a href="#">注册账号</a> | <a href="#">忘记密码</a></p>
                </div>
                <div class="col-sm-6 text-right" style="padding: 0px">
                    <img class="img-rounded" width="100%" height="100%" src="{{ URL::asset('images/project/login_back_img.jpg') }}" />
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/login.js') }}"></script>
</body>
</html>