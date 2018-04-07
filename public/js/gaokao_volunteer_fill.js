var mVirLeft = 1;
var mVirRight = 17;

var majorData;
var majorDataLen = 0;  //专业信息通过合成对象的方式生成 无法有效计算长度
var target;
var schoolName;
var selected = [ [],[],[],[],[],[]];
var selectedMajor;
var sortTarget;

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
            $("#schoolTable").multiLineTable({
                data : response.data,
                dataHandle : function(data) {
                    var str ='<tr>' +
                            '<td>1%</td>' +
                            '<td>' + data.name + '</td>' +
                            '<td>' + data.address + '</td>' +
                            '<td>' + (data.rank == null ? '-' : data.rank) + '</td>' +
                            '<td>' + data.avg + '</td>' +
                            '<td>' + (data.infos[2017][0] === 0 ? '-' : data.infos[2017][0]) + '</td>' +
                            '<td>' + (data.infos[2017][1] === 0 ? '-' : data.infos[2017][1]) + '</td>' +
                            '<td>' + (data.infos[2017][2] === 0 ? '-' : data.infos[2017][2]) + '</td>' +
                            '<td>' + (data.infos[2016][0] === 0 ? '-' : data.infos[2016][0]) + '</td>' +
                            '<td>' + (data.infos[2016][1] === 0 ? '-' : data.infos[2016][1]) + '</td>' +
                            '<td>' + (data.infos[2016][2] === 0 ? '-' : data.infos[2016][2]) + '</td>' +
                            '<td>' + (data.infos[2015][0] === 0 ? '-' : data.infos[2015][0]) + '</td>' +
                            '<td>' + (data.infos[2015][1] === 0 ? '-' : data.infos[2015][1]) + '</td>' +
                            '<td>' + (data.infos[2015][2] === 0 ? '-' : data.infos[2015][2]) + '</td>' +
                            '<td>' + (data.infos[2018][0] === 0 ? '-' : data.infos[2018][0]) + '</td>' +
                            '<td>' + (data.infos[2018][1] === 0 ? '-' : data.infos[2018][1]) + '</td>';
                        var findSig = false;
                        for(var j = 0; j < 6; j++)
                            if(selected[j][0] == data.name) {
                                str += '<td style="padding: 2px"><button class="btn btn-sxp btn-sm"  style="padding: 5px 20px;" select-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>';
                                findSig = true;
                                break;
                            }
                        if(!findSig)
                            str += '<td style="padding: 2px"><button class="btn btn-default btn-sm"  style="padding: 5px 20px;" select-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>';
                        str += '</tr>'
                    return str;
                },
                userHandle : {
                    /**
                     * 初始化事件 用于重置指针
                     * @param data
                     * @returns {*}
                     */
                    'initData': function (originalData) {
                        return originalData;
                    },
                    /**
                     * 搜索按名称学校
                     * @param originalData
                     * @returns {Array|any[]}
                     */
                    'searchSchool': function (originalData) {
                        var name = $("#schoolName").val();
                        var data = [];
                        for (var i = 0; i < originalData.length; i++) {
                            if (originalData[i].name.indexOf(name) !== -1) {
                                data.push(originalData[i])
                            }
                        }
                        return data;
                    },
                    /**
                     * 筛选省份
                     * @param originalData
                     */
                    'fetchProvince': function (originalData) {
                        var pro = [];
                        var data = [];
                        $("#provinceFetch").find(".fetchbox-active").each(function () {
                            if ($(this).html().indexOf("gly") === -1)
                                pro.push($(this).html());
                        })
                        if (pro.length !== 0) {
                            data = [];
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
                        $(".modal-background").hide();

                        return data;
                    }
                },
                userHandleLocal : {

                    'sortASC' : function(data) {
                        var cel = $(sortTarget).parent().parent().find("th").index($(sortTarget).parent());
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
                        $(sortTarget).removeClass("glyphicon-sort-by-attributes");
                        $(sortTarget).addClass("glyphicon-sort-by-attributes-alt");

                        return data;
                    },
                    'sortDESC' : function (data) {
                        var cel = $(sortTarget).parent().parent().find("th").index($(sortTarget).parent());
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
                        $(sortTarget).removeClass("glyphicon-sort-by-attributes-alt");
                        $(sortTarget).addClass("glyphicon-sort-by-attributes");
                        return data;
                    }
                }
            })
        }
    })

    /**
     * 填写志愿按钮被点击
     */
    $('[data-toggle="fill"]').click(function () {
        var batch = $(this).parent().parent().parent().parent().prev().children().eq(0).children().eq(0).html();
        batch += $(this).parent().parent().parent().parent().prev().children().eq(1).children().eq(0).html();
        $("#batchName").html(batch);
        target = $(this).parent().parent().parent();

        window.dispatchEvent( new Event('initData') );
        $("#listModal").modal();
    })

    /**
     * 发起搜索
     */
    $("#search").click(function(){
        window.dispatchEvent( new Event('searchSchool'));
    })

    $("#schoolName").keyup(function() {
        window.dispatchEvent( new Event('searchSchool'));
    })

    /**
     * 优化体验，点击搜索框时，默认选中
     */
    $("#schoolName").focus(function () {
        $(this).select();
    })


    /**
     * 省份框点击时 赋予选中效果
     */
    $("#provinceFetch").on("click", "td", function(){
        if($(this).hasClass('fetchbox-active'))
            $(this).removeClass('fetchbox-active');
        else
            $(this).addClass('fetchbox-active');
        return false;
    })

    /**
     * 启动筛选省份的模态框
     */
    $(".glyphicon-th-list").click(function(){
        $("#provinceList").children(".border-shadow").css('position', 'fixed');
        $("#provinceList").children(".border-shadow").css('top', $(this).offset().top - document.documentElement.scrollTop+ 20);
        $("#provinceList").children(".border-shadow").css('left', $(this).offset().left - 300);
        $("#provinceList").fadeIn();
    })
    /**
     * 隐藏自定义modal
     */
    $(".modal-background").click(function () {
        $(this).fadeOut();
    })
    /**
     * 开始筛选省份
     */
    $("#fetch").click(function(){
        window.dispatchEvent( new Event('fetchProvince'));
    })

    /**
     * 排序
     */
    $("#schoolTable").on("click", ".glyphicon-sort-by-attributes", function(){
        sortTarget = $(this);
        window.dispatchEvent( new Event("sortASC"));
    })

    $("#schoolTable").on("click", ".glyphicon-sort-by-attributes-alt", function(){
        sortTarget = $(this);
        window.dispatchEvent( new Event("sortDESC") );
    })

    $("#schoolTable").on("click", "[select-btn]", function(){

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
