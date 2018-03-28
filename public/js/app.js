$(document).ready(function(){
    if ($(".sxp-footer").offset().top + $(".sxp-footer").height()  <= document.documentElement.clientHeight) {
        $(".sxp-footer").addClass("navbar-fixed-bottom");
    }
})