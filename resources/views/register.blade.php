<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>注册</title>
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
                    <form class="form-horizontal" style="margin-top: 50px" id="reg">
                        <div class="form-group">
                            <label for="cellphone" class="col-sm-3 col-sm-offset-1 control-label">手机号码</label>
                            <div class="col-sm-5">
                                <input type="text" id="cellphone" name='cellphone' class="form-control" value="" placeholder="请输入手机号码"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Verification_Code" class="col-sm-3 col-sm-offset-1 control-label">验证码</label>
                            <div class="col-sm-2">
                                <input type="text" id="Verification_Code" name='code' class="form-control" value=""/>
                            </div>
                            <div class="col-sm-3">
                                <input type="button" id="code" class="form-control" value="获取验证码" class="btn btn-sxp"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 col-sm-offset-1 control-label">密码</label>
                            <div class="col-sm-5">
                                <input type="password" id="password" name='password' class="form-control" value="" placeholder="请输入密码"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-3 col-sm-offset-1 control-label">确认密码</label>
                            <div class="col-sm-5">
                                <input type="password" id="password2" name='password2' class="form-control" value="" placeholder="确认密码"/>
                            </div>
                        </div>
                        <p class="text-danger text-center" style="margin-top: 20px" id="info">&nbsp;</p>
                        <p class="text-center"><button type="button" class="btn btn-sxp" id="register">注&nbsp;&nbsp;&nbsp;&nbsp;册</button></p>
                    </form>
                    <hr/>
                    <p class="text-center"><a href="#">登录</a> | <a href="#">忘记密码</a></p>
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
<script src="{{ URL::asset('js/register.js') }}"></script>
</body>
</html>