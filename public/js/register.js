$(document).ready(function(){
    /**
     * 注册内容js判定并获取验证码
     */
    $("#code").click(function () {
        var info=$("#info");
        var cellphone=$("#cellphone");
        var code=$("#code");
        $(this).parent().parent().find(".has-error").removeClass('has-error');
        var value=cellphone.val();
        if(value.length==0){
            info.html('手机号码不能为空');
            cellphone.parent().addClass('has-error');
        }else if(!/^(13[0-9]|14[0-9]|17[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(value)){
            info.html('请输入正确的手机号！');
            cellphone.parent().addClass('has-error');
        }else{
            $.post(URL + "/user/check",
                {_token : _token,
                phone:value},
                function (data) {
                    if(data=='yes'){
                        info.html('手机号码已存在！');
                        cellphone.parent().addClass('has-error');
                    }else{
                        send(code,info,value);
                    }
                },
                "html"
            );
        }
    });
    /**
     * 忘记密码内容判定并获取验证码
     */
    $("#code_make").click(function () {
        var cellphone=$("#cellphone").val();
        var code_make=$("#code_make");
        var info=$("#info");
        if(cellphone.length==0){
            info.html("请输入手机号码！");
        }else if(!/^(13[0-9]|14[0-9]|17[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(cellphone)){
            info.html("请输入正确的手机号码！");
        }else{
            $.post(URL + "/user/check",
                {_token : _token,
                phone:cellphone},
                function (data) {
                    if(data=='no'){
                        info.html('手机号码不存在！');
                        // cellphone.parent().addClass('has-error');
                    }else{
                        send(code_make,info,cellphone);
                    }
                },
                "html"
            );
        }
    });
    /**
     * 修改密码下一步按钮事件
     */
    $("#next").click(function () {
        var cellphone=$("#cellphone").val();
        var code=$("#Verification_Code").val();
        var info=$("#info");
        var password=$("#password");
        var phone=$("#phone");
        var codes=$("#codes");
        var password_repeat=$("#password_repeat");
        var reset=$("#reset");
        var next=$("#next");
        if(cellphone.length==0){
            info.html("请输入手机号码！");
        }else if(code.length==0){
            info.html("请输入验证码！");
        }else{
            $.post(URL + "/user/forget",
                {'code':code,
                'phone':cellphone,
                _token : _token,},
                function (response) {
                    if(response.status==false){
                        info.html(response.info);
                    }else{
                        phone.addClass('forget');
                        codes.addClass('forget');
                        next.addClass('forget');
                        info.html('');
                        password.removeClass('forget');
                        password_repeat.removeClass('forget');
                        reset.removeClass('forget');
                    }
                },
                'json'
            );
        }
    });

    /**
     * 发送验证码方法
     * @param code
     * @param info
     * @param value
     */
    function send(code,info,value) {
        code.attr("disabled",true);
        var count=60;
        $.post(URL + "/user/send",
            {phone:value,
            _token : _token},
            function(data)
            {
                if(data=='ok'){
                    var countdown = setInterval(show,1000);
                    function show() {
                        code.val(count+'s后重新获取');
                        if(count<=1){
                            code.val("重新获取");
                            code.removeAttr("disabled");
                            clearInterval(countdown);
                        }
                        count--;
                    }
                    info.html('验证码已发送，请注意接收！');
                }else{
                    info.html('验证码发送失败！请稍候重试！');
                }
            }
        );
    };
    /**
     * 修改密码按钮
     */
    $("#modify").click(function () {
        var info=$("#info");
        var cellphone=$("#cellphone").val();
        var password1=$("#password1").val();
        var password2=$("#password2").val();
        var code=$("#Verification_Code").val();
        if(password1.length==0){
            info.html('请输入密码！');
        }else if(password2.length==0){
            info.html("请确认密码！");
        }else if(password2!=password1){
            info.html("两次密码不一致！");
        }else{
            info.html("数据验证中，请稍候！");
            $.post(URL + "/user/modify",
                {_token : _token,
                'phone':cellphone,
                'code':code,
                'password1':password1,
                'password2':password2,},
                function (response) {
                    if(response.status==true){
                        info.html("密码修改成功！请登录！");
                        window.location.href = URL + '/test/login';
                    }else{
                        info.html(response.info);
                    }
                })
        }
    });
    /**
     * 注册按钮
     */
    $("#register").click(function () {
        var cellphone=$("#cellphone").val();
        var code=$("#Verification_Code").val();
        var password=$("#password").val();
        var password2=$("#password2").val();
        if(cellphone.length==0){
            $("#info").html('请输入手机号码！');
        }else if(code.length==0){
            $("#info").html('请输入验证码！');
        }else if(password.length==0){
            $("#info").html('请输入密码！');
        }else if(password2.length==0){
            $("#info").html('请确认密码！');
        }else if(password!=password2){
            $("#info").html('两次密码不一致！');
        }else{
            $.post(URL + "/user/register",
                {_token : _token,
                    cellphone:cellphone,
                    code:code,
                    password:password,
                    password2:password2
                },
                function (response) {
                    if(response.status === false) {
                        $("#info").html(response.info);
                    } else {
                        alert(response.info);
                        window.location.href = URL + '/test/login';
                    }
                },'json');
        }
    })
});