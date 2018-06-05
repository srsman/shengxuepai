var citylist;
var _provinceID = 0;
var _cityId = 0;

$(document).ready(function () {

    $.get(URL + "/js/city.min.js", function(response){
        citylist = eval( "(" + response + ")");
        refresh_province();
    });

    $("#province").change(function(){
        _provinceID = $(this).val();
        refresh_city();
    })

    $("#city").change(function(){
        _cityId = $(this).val();
        refresh_country();
    })

    $.get(URL + "/user/get_info", function(response) {
        if(response.status == true) {

        } else {
            alert("拉取用户基本信息失败，请重试");
            window.location.reload();
        }
    })

})

function  refresh_province() {
    var str = '';
    for (var i = 0; i < citylist.length; i++) {
       str += '<option value=' + i+ '>' + citylist[i].p +'</option>'
    }
    $("#province").html(str);
    refresh_city();
}

function refresh_city() {
    var str = '';
    if (typeof citylist[_provinceID].c == 'undefined') {
        $("#city").hide();
    } else {
        var len = citylist[_provinceID].c.length;
        for (var i = 0; i < len; i++) {
            str += '<option value=' + i+ '>' + citylist[_provinceID].c[i].n +'</option>'
        }
        $("#city").html(str);
        $("#city").show();
        _cityId = 0;  //重置ID避免BUG
    }
    refresh_country();
}

function refresh_country() {
    var str = '';
    if (typeof citylist[_provinceID].c[_cityId].a == 'undefined') {
        $("#country").hide();
    } else {
        var len = citylist[_provinceID].c[_cityId].a.length;
        for (var i = 0; i < len; i++) {
            str += '<option value=' + i+ '>' + citylist[_provinceID].c[_cityId].a[i].s +'</option>'
        }
        $("#country").html(str);
        $("#country").show();
    }
}