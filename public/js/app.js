$(document).ready(function(){
    if ($(".sxp-footer").offset().top + $(".sxp-footer").height()  <= document.documentElement.clientHeight) {
        $(".sxp-footer").addClass("navbar-fixed-bottom");
    }

    $(["[data-toggle='tooltip']"]).tooltip();

    $(".custom-checkbox").mouseover(function () {
        if($(this).css('background-position') != '-10px -218px')
            $(this).css('background-position', '-10px -118px');
    })

    $(".custom-checkbox").mouseout(function () {
        if($(this).css('background-position') != '-10px -218px')
            $(this).css('background-position', '-10px -18px');
    })

    $(".custom-checkbox").click(function () {
        if($(this).css('background-position') == '-10px -118px') {
            $(this).css('background-position', '-10px -218px');
        } else {
            $(this).css('background-position', '-10px -118px');
        }
    })
})