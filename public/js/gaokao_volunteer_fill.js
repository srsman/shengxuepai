var data;
var virLeft = 1;
var virRight = 17;
var mVirLeft = 1;
var mVirRight = 17;
var originalData;
var majorData;
var majorDataLen = 0;  //专业信息通过合成对象的方式生成 无法有效计算长度
var target;
var schoolName;
var selected = [ [],[],[],[],[],[]];
var selectedMajor;

$(document).ready(function(){

    window.onbeforeunload = function(){
        return "当前页面还未保存，确认离开吗?";
    }

    $.get(URL + '/fill/get_school?classify='+classify+'&batch=' + batch, function(response) {
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
        var batch = $(this).parent().parent().parent().parent().prev().children().eq(0).children().eq(0).html();
        batch += $(this).parent().parent().parent().parent().prev().children().eq(1).children().eq(0).html();
        $("#batchName").html(batch);
        target = $(this).parent().parent().parent();
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
     * FireFox浏览器特殊 处理学校列表滚动
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

    /**
     * 处理专业列表滚动
     */
    var mtTarget = document.getElementById("majorTable");
    mtTarget.addEventListener("DOMMouseScroll", function(event) {
        majorWheelMove(event.detail)
    });

    /**
     * 其他浏览器
     */
    mtTarget.onmousewheel = function(event) {
        event = event || window.event;
        majorWheelMove(-event.wheelDelta);
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
        $("#provinceList").children(".border-shadow").css('position', 'fixed');
        $("#provinceList").children(".border-shadow").css('top', $(this).offset().top - document.documentElement.scrollTop+ 20);
        $("#provinceList").children(".border-shadow").css('left', $(this).offset().left - 300);
        $("#provinceList").fadeIn();
    })
    $(".modal-background").click(function () {
        $(this).fadeOut();
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
        console.log(selected)
        $("#majorTable").children().eq(0).children(":gt(1)").remove();
        $("#majorTable").children().eq(0).append('<tr  class="text-center"><td colspan="15">数据请求中，请稍后</td></tr>')

        schoolName = $(this).parent().parent().children().eq(1).html();
        selectedMajor = [];
        for(var i = 0; i < selected.length; i++) {
            if(selected[i][0] == schoolName) {
                selectedMajor = selected[i][1];
                break;
            }
        }
        $("#schoolTitle").html(schoolName);
        $.get(URL + '/fill/get_major?classify='+classify+'&batch='+batch+'&name=' + encodeURI(schoolName), function(response){
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
               $("#majorTable").children().eq(0).children(":gt(1)").remove();
               majorData = info;
               initMajor();
           }
        })
        $("#majorList").fadeIn();
    })

    $("#majorTable").on("click", "[major-btn]", function(){

        if($(this).hasClass('btn-sxp')) {
            $(this).removeClass('btn-sxp');
            $(this).addClass('btn-default')
        } else {
            if($(this).parent().parent().parent().find(".btn-sxp").length >= 6) {
                var top = $(this).offset().top - 30 - document.documentElement.scrollTop;
                var left = $(this).offset().left;
                console.log($(this).offset());
                $("#majorList").append(' <div class="tooltip fade top in" major-alert role="tooltip" style="position:fixed;top: '+top+'px; left: '+left+'px; display: block;z-index:1055">\n' +
                    '                        <div class="tooltip-arrow" style="left: 50%;"></div>\n' +
                    '                        <div class="tooltip-inner" >只能选择6个专业</div>\n' +
                    '                    </div>')
                window.setTimeout(function(){
                    $("[major-alert]").fadeOut();
                    $("[major-alert]").remove();
                }, 2000)
                return;
            }
            $(this).addClass('btn-sxp');
            $(this).removeClass('btn-default')
        }
        return false;
    })

    $("#majorList").on('click', 'div', function () {
        //禁止事件冒泡
        return false;
    })

    for(var i = 1; i <= 6; i++) {
        $("[draggid-"+i+"]").draggable({
            containment: "[draggpid-"+i+"]",
            revert: true
        });
    }
    $(".underline-p").droppable({
        drop : function(event, ui) {
            $(this).css('color', 'black');
            var t = $(ui.draggable).html();
            $(ui.draggable).html($(this).html());
            $(this).html(t);
        },
        over : function(event, ui) {
            $(this).css('color', 'rgb(78,201,142)');
        },
        out : function(event, ui) {
            $(this).css('color', 'black');
        }
    });

    $("#save").click(function () {
        var majors = [];
        $("#majorTable").find(".btn-sxp").each(function(){
            majors.push($(this).parent().parent().children().eq(0).html())
        })
        $(target).children().eq(0).children().eq(1).children().eq(0).html(schoolName);
        var id = $("#fillList").children().index($(target).parent().parent());
        selected[id / 2 - 1] = [schoolName, []];

        for(var i = 0; i < majors.length; i++) {
            selected[id / 2 - 1][1].push(majors[i]);
            $(target).children().eq( parseInt(i / 2) + 1).children().eq(i % 2 == 0 ? 1 : 3).children().eq(0).html(majors[i]);
        }
        $("#majorList").fadeOut();
        $("#listModal").modal('hide');
    })

    $("#submit").click(function(){
        if($("#tableName").val().length == 0) {
            $("#tableName").parent().addClass('has-error');
            return;
        }

        $("#tableName").parent().removeClass('has-error');

        var info = {};
        $("#fillList").find(".row").each(function(index){
            var form = $(this).find(".form-horizontal");
            var tmp = {};
            $(form).find(".form-control-static").each(function(index){
                if(index == 0) //school
                    tmp.s = $(this).html();
                else
                    tmp["m" + index] = $(this).html();
            })
            tmp.o = $(form).find('.custom-checkbox').eq(0).css('background-position') === '-10px -218px' ? 1 : 0;
            if(index == 0)
                info.o = $(form).find('.custom-checkbox').eq(1).css('background-position') === '-10px -218px' ? 1 : 0;

            info[index] = tmp;
        })
        info = JSON.stringify(info);
        if(info.length <= 409 ) {
            $("#submit_info").html("还未填写任何内容");
            return;
        }
        $.post(URL + "/fill/save_vol", {info:info, _token:_token, type:type,batch:batch,table_name:$("#tableName").val()}, function(response){
            if(response.status == true) {
                $("#submit_info").html("保存成功");
            } else {
                $("#submit_info").html("保存失败");
            }
        });
        $("#submit_info").html("保存中，请稍后......");
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
            '<td>' + (data[i].infos[2018][1] === 0 ? '-' : data[i].infos[2018][1]) + '</td>';
        var findSig = false;
        for(var j = 0; j < 6; j++)
            if(selected[j][0] == data[i].name) {
                str += '<td style="padding: 2px"><button class="btn btn-sxp btn-sm"  style="padding: 5px 20px;" select-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>';
                findSig = true;
                break;
            }
        if(!findSig)
            str += '<td style="padding: 2px"><button class="btn btn-default btn-sm"  style="padding: 5px 20px;" select-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>';
        str += '</tr>'
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

function initMajor()
{
    majorDataLen = 0;
    mVirLeft = 1;
    mVirRight = 17;

    var str = '';
    for(row in majorData) {
        majorDataLen++;
        str += '<tr hidden>' +
            '<td colspan="2">'+row+'</td>' +
            '<td>'+majorData[row].classify+'</td>' +
            '<td>'+ (majorData[row][2016][0] === 0 ? '-' : majorData[row][2016][0])+'</td>' +
            '<td>'+ (majorData[row][2016][1] === 0 ? '-' : majorData[row][2016][1])+'</td>' +
            '<td>'+ (majorData[row][2016][2] === 0 ? '-' : majorData[row][2016][2])+'</td>' +
            '<td>'+ (majorData[row][2015][0] === 0 ? '-' : majorData[row][2015][0])+'</td>' +
            '<td>'+ (majorData[row][2015][1] === 0 ? '-' : majorData[row][2015][1])+'</td>' +
            '<td>'+ (majorData[row][2015][2] === 0 ? '-' : majorData[row][2015][2])+'</td>' +
            '<td>'+ (majorData[row][2014][0] === 0 ? '-' : majorData[row][2014][0])+'</td>' +
            '<td>'+ (majorData[row][2014][1] === 0 ? '-' : majorData[row][2014][1])+'</td>' +
            '<td>'+ (majorData[row][2014][2] === 0 ? '-' : majorData[row][2014][2])+'</td>' +
            '<td>'+ (majorData[row][2017][0] === 0 ? '-' : majorData[row][2017][0])+'</td>' +
            '<td>-</td>';
        var findSig = false;
        for(var j = 0; j < selectedMajor.length; j++)
            if(selectedMajor[j] == row) {
                str += '<td style="padding: 2px"><button class="btn btn-sxp btn-sm"  style="padding: 5px 20px;" major-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>';
                findSig = true;
                break;
            }
        if(!findSig)
            str += '<td style="padding: 2px"><button class="btn btn-default btn-sm"  style="padding: 5px 20px;" major-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>';
        str += '</tr>';
    }
    str += "<tr hidden class='text-center text-success'><td colspan='15'>到底啦~</td></tr>"
    $("#majorTable").append(str);
    $("#majorTable").children().eq(0).children(":lt("+mVirRight+")").show();
}

function majorWheelMove(angle) {
    if (majorDataLen <= 14) {
        return;
    }
    if (angle > 0) {
        mVirLeft += 5;
        mVirRight += 5;
    } else {
        mVirLeft -= 5;
        mVirRight -= 5;
    }
    if (mVirLeft <= 1) {
        mVirLeft = 1;
        mVirRight = 17;
    }
    if (mVirRight >= majorDataLen + 3) {
        mVirLeft = majorDataLen - 13;
        mVirRight = majorDataLen + 3;
    }
    $("#majorTable").children().eq(0).children(":gt(1)").hide();
    $("#majorTable").children().eq(0).children(":lt(" + mVirRight + "):gt(" + mVirLeft + ")").show();
}
