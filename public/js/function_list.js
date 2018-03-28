$(document).ready(function () {
    $(".img-up").mouseover(function () {
        var that = $(this);
        window.setTimeout(function(){
            $("#zoom").hide();
            $("#zoom").attr('src', $(that).attr('src'));
            $("#zoom").css('top', $(that).offset().top - 100);
            $("#zoom").css('left', $(that).offset().left - 400);
            $("#zoom").fadeIn();
        }, 600);
    })

    $(".img-up").mouseout(function () {
        $("#zoom").hide();
    })
})