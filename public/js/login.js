$(document).ready(function(){
    $("#signIn").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();

        $(this).parent().parent().find(".has-error").removeClass('has-error');

        if(username.length == 0) {
            $("#username").parent().addClass('has-error');
        } else if(password.length == 0) {
            $("#password").parent().addClass('has-error');
        } else {
            $.post(URL + "/user/login", {
                username:username,
                password:password,
                _token : _token,
            }, function(response){
                if(response.status == true) {
                    window.location.href = URL + '/functions';
                } else {
                    $("#info").html(response.info)
                }
            })
        }
    })
})