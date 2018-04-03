$(document).ready(function(){
    if ($(".sxp-footer").offset().top + $(".sxp-footer").height()  <= document.documentElement.clientHeight) {
        $(".sxp-footer").addClass("navbar-fixed-bottom");
    }

    $(["[data-toggle='tooltip']"]).tooltip();

    $(".custom-checkbox").mouseover(function () {
        if($(this).css('background-position') != '-10px -218px')   //选中
            $(this).css('background-position', '-10px -118px');   //hover
    })

    $(".custom-checkbox").mouseout(function () {
        if($(this).css('background-position') != '-10px -218px')   //选中
            $(this).css('background-position', '-10px -18px');    //初始
    })

    $(".custom-checkbox").click(function () {
        if($(this).css('background-position') == '-10px -118px') {  //hover
            $(this).css('background-position', '-10px -218px');    //选中
        } else {
            $(this).css('background-position', '-10px -118px');    //hover
        }
    })
})