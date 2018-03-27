$(document).ready(function(){
    $("#signIn").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();

        $(this).parent().parent().find("p.text-danger").remove();
        $(this).parent().parent().find(".has-error").removeClass('has-error');

        if(username.length == 0) {
            $("#username").after('<p class="text-danger">账号不能为空</p>');
            $("#username").parent().addClass('has-error');
        } else if(password.length == 0) {
            $("#password").after('<p class="text-danger">密码不能为空</p>');
            $("#password").parent().addClass('has-error');
        } else {
            $.post("/sxp/user/login", {
                username:username,
                password:password,
                _token : _token,
            }, function(response){
                if(response.status == true) {

                } else {
                    $("#signIn").parent().before('<p class="text-danger text-center">' + response.info + '</p>')
                }
            })
        }
    })
})