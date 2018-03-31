var data;
var virLeft = 1;
var virRight = 17;
var originalData;

$(document).ready(function(){
    $.get(URL + '/fill/get_school?classify=2&batch=2', function(response) {
        if (response.status == true) {
            for(var i = 0; i < response.data.length; i++) {
                if (typeof response.data[i].avg == 'undefined') {
                    var avg = response.data[i].infos[2017][1] + response.data[i].infos[2016][1] + response.data[i].infos[2015][1];
                    var k = 3;
                    if (response.data[i].infos[2017][1] == 0)
                        k--;
                    if (response.data[i].infos[2016][1] == 0)
                        k--;
                    if (response.data[i].infos[2015][1] == 0)
                        k--;
                    k = k == 0 ? 1 : k;
                    avg /= k;
                    response.data[i].avg = parseInt(avg);
                }
            }
            originalData = data = response.data;
            init();
        }
    })

    $('[data-toggle="fill"]').click(function () {
        data = originalData;
        init();
        $("#listModal").modal();
    })
    $("#search").click(function(){
        searchBySchoolName($("#schoolName").val());
    })

    $("#schoolName").keyup(function() {
        searchBySchoolName($("#schoolName").val());
    })

    $("#schoolName").focus(function () {
        $(this).select();
    })

    /**
     * FireFox浏览器特殊
     */
    var stTarget = document.getElementById("schoolTable");
    stTarget.addEventListener("DOMMouseScroll", function(event) {
        wheelMove(event.detail)
    });

    /**
     * 其他浏览器
     */
    stTarget.onmousewheel = function(event) {
        event = event || window.event;
        wheelMove(-event.wheelDelta);
    };

    $("#provinceFetch").on("click", "td", function(){
        if($(this).hasClass('fetchbox-active'))
            $(this).removeClass('fetchbox-active');
        else
            $(this).addClass('fetchbox-active');
        return false;
    })

    /**
     * 筛选省份
     */
    $(".glyphicon-th-list").click(function(){
        $("#provinceList").children(".border-shadow").css('position', 'absolute');
        $("#provinceList").children(".border-shadow").css('top', $(this).offset().top + 20);
        $("#provinceList").children(".border-shadow").css('left', $(this).offset().left - 300);
        $("#provinceList").fadeIn();
    })
    $(".modal-background").click(function () {
        $(this).hide();
    })
    /**
     * 筛选省份
     */
    $("#fetch").click(function(){
        var pro = new Array();
        $("#provinceFetch").find(".fetchbox-active").each(function(){
            if($(this).html().indexOf("gly") === -1)
                pro.push($(this).html());
        })
        if(pro.length != 0) {
            data = new Array();
            for (var i = 0; i < originalData.length; i++) {
                for (var j = 0; j < pro.length; j++)
                    if (originalData[i].address.indexOf(pro[j]) !== -1) {
                        data.push(originalData[i]);
                        break;
                    }
            }
        } else {
            data = originalData;
        }
        init();
        $(".modal-background").hide();
    })

    /**
     * 排序
     */
    $("#schoolTable").on("click", ".glyphicon-sort-by-attributes", function(){
        var cel = $(this).parent().parent().find("th").index($(this).parent());
        data.sort(function(a, b) {
            if(cel == 3) {
                return a.rank - b.rank;
            } else if(cel == 4) {
                return a.avg - b.avg;
            } else if(cel == 5 || cel == 7) {
                return a.infos[2017][cel-5] - b.infos[2017][cel-5];
            } else if(cel == 8 || cel == 10) {
                return a.infos[2016][cel-8] - b.infos[2016][cel-8];
            } else if(cel == 11 || cel == 13) {
                return a.infos[2015][cel-11] - b.infos[2015][cel-11];
            } else {
                return a.infos[2018][0] - b.infos[2018][0];
            }
        })
        $(".glyphicon-sort-by-attributes-alt").each(function(){
            $(this).removeClass("glyphicon-sort-by-attributes-alt");
            $(this).addClass("glyphicon-sort-by-attributes");
        })
        $(this).removeClass("glyphicon-sort-by-attributes");
        $(this).addClass("glyphicon-sort-by-attributes-alt");
        init();
    })

    $("#schoolTable").on("click", ".glyphicon-sort-by-attributes-alt", function(){
        var cel = $(this).parent().parent().find("th").index($(this).parent());
        data.sort(function(a, b) {
            if(cel == 3) {
                return b.rank - a.rank;
            } else if(cel == 4) {
                return b.avg - a.avg;
            } else if(cel == 5 || cel == 7) {
                return b.infos[2017][cel-5] - a.infos[2017][cel-5];
            } else if(cel == 8 || cel == 10) {
                return b.infos[2016][cel-8] - a.infos[2016][cel-8];
            } else if(cel == 11 || cel == 13) {
                return b.infos[2015][cel-11] - a.infos[2015][cel-11];
            } else {
                return b.infos[2018][0] - a.infos[2018][0];
            }
        })
        $(".glyphicon-sort-by-attributes").each(function(){
            $(this).removeClass("glyphicon-sort-by-attributes");
            $(this).addClass("glyphicon-sort-by-attributes-alt");
        })
        $(this).removeClass("glyphicon-sort-by-attributes-alt");
        $(this).addClass("glyphicon-sort-by-attributes");
        init();
    })

    $("#schoolTable").on("click", "[select-btn]", function(){
        $("#majorTable").children().eq(0).children(":gt(1)").remove();
        $("#majorTable").children().eq(0).append('<tr  class="text-center"><td colspan="15">数据请求中，请稍后</td></tr>')

        var name = $(this).parent().parent().children().eq(1).html();
        $.get(URL + '/fill/get_major?classify=2&batch=2&name=' + name, function(response){
           if(response.status) {
               var info = {};
               for(var i = 0; i < response.data.length; i++) {
                   if(typeof info[response.data[i].major_name] == 'undefined') {
                       info[response.data[i].major_name] = {
                           'classify' : '理科',
                           '2016' : [0,0,0],
                           '2015' : [0,0,0],
                           '2014' : [0,0,0],
                           '2017' : [0],
                           'spec' : '',
                       };
                   }
                   info[response.data[i].major_name][response.data[i].year] = [response.data[i].min_score, response.data[i].differ, response.data[i].number]
               }
               var str = '';
               for(row in info) {
                   str += '<tr>' +
                       '<td colspan="2">'+row+'</td>' +
                       '<td>'+info[row].classify+'</td>' +
                       '<td>'+ (info[row][2016][0] === 0 ? '-' : info[row][2016][0])+'</td>' +
                       '<td>'+ (info[row][2016][1] === 0 ? '-' : info[row][2016][1])+'</td>' +
                       '<td>'+ (info[row][2016][2] === 0 ? '-' : info[row][2016][2])+'</td>' +
                       '<td>'+ (info[row][2015][0] === 0 ? '-' : info[row][2015][0])+'</td>' +
                       '<td>'+ (info[row][2015][1] === 0 ? '-' : info[row][2015][1])+'</td>' +
                       '<td>'+ (info[row][2015][2] === 0 ? '-' : info[row][2015][2])+'</td>' +
                       '<td>'+ (info[row][2014][0] === 0 ? '-' : info[row][2014][0])+'</td>' +
                       '<td>'+ (info[row][2014][1] === 0 ? '-' : info[row][2014][1])+'</td>' +
                       '<td>'+ (info[row][2014][2] === 0 ? '-' : info[row][2014][2])+'</td>' +
                       '<td>'+ (info[row][2017][0] === 0 ? '-' : info[row][2017][0])+'</td>' +
                       '<td>-</td>' +
                       '<td style="padding: 2px"><button class="btn btn-default btn-sm"  major-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>' +
                       '</tr>'
               }

               $("#majorTable").children().eq(0).children(":gt(1)").remove();
               $("#majorTable").append(str);
           }
        })
        $("#majorModal").modal();
    })

})

function init() {
    $("#progressBar").css("width", "0%");
    $("#schoolTable").children().eq(0).children(":gt(1)").remove();
    var str = '';
    for(var i = 0; i < data.length; i++) {
        str += '<tr hidden>' +
            '<td>1%</td>' +
            '<td>' + data[i].name + '</td>' +
            '<td>' + data[i].address + '</td>' +
            '<td>' + (data[i].rank == null ? '-' : data[i].rank) + '</td>' +
            '<td>' + data[i].avg + '</td>' +
            '<td>' + (data[i].infos[2017][0] === 0 ? '-' : data[i].infos[2017][0]) + '</td>' +
            '<td>' + (data[i].infos[2017][1] === 0 ? '-' : data[i].infos[2017][1]) + '</td>' +
            '<td>' + (data[i].infos[2017][2] === 0 ? '-' : data[i].infos[2017][2]) + '</td>' +
            '<td>' + (data[i].infos[2016][0] === 0 ? '-' : data[i].infos[2016][0]) + '</td>' +
            '<td>' + (data[i].infos[2016][1] === 0 ? '-' : data[i].infos[2016][1]) + '</td>' +
            '<td>' + (data[i].infos[2016][2] === 0 ? '-' : data[i].infos[2016][2]) + '</td>' +
            '<td>' + (data[i].infos[2015][0] === 0 ? '-' : data[i].infos[2015][0]) + '</td>' +
            '<td>' + (data[i].infos[2015][1] === 0 ? '-' : data[i].infos[2015][1]) + '</td>' +
            '<td>' + (data[i].infos[2015][2] === 0 ? '-' : data[i].infos[2015][2]) + '</td>' +
            '<td>' + (data[i].infos[2018][0] === 0 ? '-' : data[i].infos[2018][0]) + '</td>' +
            '<td>' + (data[i].infos[2018][1] === 0 ? '-' : data[i].infos[2018][1]) + '</td>' +
            '<td style="padding: 2px"><button class="btn btn-default btn-sm"  select-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>' +
            '</tr>'
    }
    virLeft = 1;
    virRight = 17;
    str += "<tr hidden class='text-center text-success'><td colspan='17'>到底啦~</td></tr>"
    $("#schoolTable").append(str);
    $("#schoolTable").children().eq(0).children(":lt("+virRight+")").show();

}

function searchBySchoolName(name) {
    data = new Array();
    for(var i = 0; i < originalData.length; i++) {
        if(originalData[i].name.indexOf(name) !== -1) {
            data.push(originalData[i])
        }
    }
    init();
}

function wheelMove(angle) {
    if(!$("#listModal").attr('hidden')) {
        if(data.length <= 14) {
            $("#progressBar").css("width", "0%");
            return;
        }
        if(angle > 0) {
            virLeft += 5;
            virRight += 5;
        } else {
            virLeft -= 5;
            virRight -= 5;
        }
        if(virLeft <= 1) {
            virLeft = 1;
            virRight = 17;
        }
        if(virRight >= data.length + 3) {
            virLeft = data.length - 13;
            virRight = data.length + 3;
        }
        $("#schoolTable").children().eq(0).children(":gt(1)").hide();
        $("#schoolTable").children().eq(0).children(":lt("+virRight+"):gt("+virLeft+")").show();

        var percentage = parseInt(virLeft * 100 / (data.length - 14));
        $("#progressBar").css("width", percentage + "%");
    }
}