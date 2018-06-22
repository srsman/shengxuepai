var citylist;
var _provinceID = 0;
var _cityId = 0;
var initProvince, initCity, initCountry;

$(document).ready(function () {

    initProvince = $("#hiddenP").val();
    initCity = $("#hiddenC").val();
    initCountry = $("#hiddenR").val();

    $("#score").change(function() {
        var val = $(this).val();
        var type = $("[name='major']:checked").val();
        if(val >= 0 && val <= 750) {
            $.post(URL + "/user/rank", {score: val, type: type, _token: _token}, function (response) {
                if (response.status) {
                    $("#rank").val(response.rank);
                } else {
                    $("#scoreInfo").show();

                    window.setTimeout(function() {
                        $("#score").val($("#originalScore").val())
                        $("#scoreInfo").hide();
                    }, 3000)
                }
            })
        } else {
            $("#scoreInfo").show();

            window.setTimeout(function() {
                $("#score").val($("#originalScore").val())
                $("#scoreInfo").hide();
            }, 3000)
        }


    })

    $("#submit").click(function() {
       var province = $("#province").find("option:selected").text();
       var city = $("#city").find("option:selected").text();;
       var country = $("#country").find("option:selected").text();;

       var grade = $("#grade").val();
       var classes = $("#class").val();
       var school = $("#school").val();

       var name = $("#name").val();
       var sex = $("[name='sex']:checked").val();
       var type = $("[name='major']:checked").val();
       var year = $("#year").val();

       var score = $("#score").val();
       var rank = $("#rank").val();

       $.post(URL + "/user/update", {
           province:province,
           city : city,
           country:country,
           grade:grade,
           classes:classes,
           name:name,
           school:school,
           sex:sex,
           type:type,
           year:year,
           score:score,
           rank:rank,
           _token:_token,
       }, function(response){
            if(response.status) {
                alert("更新成功")
                window.location.reload();
            } else {
                alert("更新失败")
            }
       });
    });


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

    $("#submit").click(function() {
        var name = $("#name").val();
        var school = $("#school").val();
        var _class = $("#class").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var country = $("#country").val();
        var sex;
        var classify;
        var year;
        var score;
    })
})

function  refresh_province() {
    var str = '';
    for (var i = 0; i < citylist.length; i++) {
        if(initProvince == citylist[i].p) {
            str += '<option selected value=' + i + '>' + citylist[i].p + '</option>'
            _provinceID = i;
        } else
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
            if(initCity == citylist[_provinceID].c[i].n) {
                str += '<option selected value=' + i + '>' + citylist[_provinceID].c[i].n + '</option>'
                _cityId = i;
            } else {
                str += '<option value=' + i + '>' + citylist[_provinceID].c[i].n + '</option>'
            }
        }
        $("#city").html(str);
        $("#city").show();
        //_cityId = 0;  //重置ID避免BUG
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
            if(initCountry == citylist[_provinceID].c[_cityId].a[i].s)
                str += '<option selected value=' + i+ '>' + citylist[_provinceID].c[_cityId].a[i].s +'</option>'
            else
                str += '<option value=' + i+ '>' + citylist[_provinceID].c[_cityId].a[i].s +'</option>'
        }
        $("#country").html(str);
        $("#country").show();
    }
}