/**
 * 自主招生
 */

var sortTarget;
var flag = 2;
var container = [];
var del = "<th class='text-center'>本地化率<span style='cursor: pointer' class='glyphicon glyphicon-sort-by-attributes'></span></th><th class='text-center'>川初审人数</th><th class='text-center'>川复试人数</th>";

$(document).ready(function () {
    $.get(URL+'/zs/get_school',function (response) {
        if(response.status==true){
            $("#schoolTable").multiLineTable({
                data:response.data,
                length:10,
                wheelLength : 5,
                dataHandle:function (data) {
                    if(flag==0){
                        var str = '<tr>'+
                            '<td>' + data.name+'</td>' +
                            '<td>' + data.province + '</td>'+
                            '<td>' + data.new_number + '</td>' +
                            '<td>' + data.new_first_pass + '</td>' +
                            '<td>' + (data.new_pass_lv === 0 ? '-' : data.new_pass_lv+ '%') + '</td>' +
                            '<td>' + (data.new_plan_zs === 0 ? '-' : data.new_plan_zs) + '</td>' +
                            '<td>' + data.new_next_pass + '</td>' +
                            '<td>' + (data.new_next_pass_lv ===0 ? '-' : data.new_next_pass_lv + '%') + '</td>' +
                            '<td>' + (data.local_lv === 0 ? '-' : data.local_lv + '%') + '</td>' +
                            '<td>' + (data.sichuan_first_number === 0 ? '-' : data.sichuan_first_number) + '</td>' +
                            '<td>' + (data.sichuan_next_number === 0 ? '-' : data.sichuan_next_number) + '</td>' +
                            '</tr>';
                    }else if(flag==1){
                        var str = '<tr>'+
                        '<td>' + data.name+'</td>' +
                        '<td>' + data.province + '</td>'+
                        '<td>' + (data.old_number === 0 ? '-' : data.old_number) + '</td>' +
                        '<td>' + (data.old_first_pass === 0 ? '-' : data.old_first_pass) + '</td>' +
                        '<td>' + (data.old_pass_lv === 0 ? '-' : data.old_pass_lv + '%') + '</td>' +
                        '<td>' + (data.old_plan_zs === 0 ? '-' : data.old_plan_zs) + '</td>' +
                        '<td>' + (data.old_next_pass === 0 ? '-' : data.old_next_pass) + '</td>' +
                        '<td>' + (data.old_next_pass_lv === 0 ? '-' : data.old_next_pass_lv + '%') + '</td>' +
                        '</tr>';
                    }else if(flag==2){
                        var str = '<tr>'+
                            '<td>' + data.name+'</td>' +
                            '<td>' + data.province + '</td>'+
                            '<td>' + data.new_number + '</td>' +
                            '<td>' + data.new_first_pass + '</td>' +
                            '<td>' + (data.new_pass_lv === 0 ?'-' : data.new_pass_lv + '%') + '</td>' +
                            '<td>' + (data.new_plan_zs === 0 ? '-' : data.new_plan_zs) + '</td>' +
                            '<td>' + data.new_next_pass + '</td>' +
                            '<td>' + (data.new_next_pass_lv === 0 ? '-' : data.new_next_pass_lv + '%') + '</td>' +
                            '</tr>';
                    }
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
                     * 搜索按学校名称
                     * @param originalData
                     * @returns {Array|any[]}
                     */
                    'searchSchool' : function(originalData){
                        container=[];
                        var name = $("#schoolName").val();
                        var data = [];
                        for(var i = 0; i < originalData.length; i++) {
                            if(originalData[i].name.indexOf(name) !== -1) {
                                data.push(originalData[i]);
                            }
                        }
                        container=data;
                        return data;
                    },
                    /**
                     * 筛选省份
                     * @param originalData
                     */
                    'fetchProvince': function (originalData) {
                        container=[];
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
                                    if (originalData[i].province.indexOf(pro[j]) !== -1) {
                                        data.push(originalData[i]);
                                        break;
                                    }
                            }
                        } else {
                            data = originalData;
                        }
                        $(".modal-background").hide();
                        container=data;
                        return data;
                    },
                    /***
                     * 选项卡
                     */
                    'Tab':function (originalData) {
                        if(container.length != ''){
                            data = container;
                        }else{
                            data = originalData;
                        }
                        return data;
                    }
                },
                userHandleLocal : {

                    'sortASC' : function(data) {
                        container=[];
                        var cel = $(sortTarget).parent().parent().find("th").index($(sortTarget).parent());
                        data.sort(function(a, b) {
                            if(cel == 2) {
                                if(flag == 0){
                                    return a.new_number - b.new_number;
                                }else{
                                    return a.old_number - b.old_number;
                                }
                            } else if(cel == 4) {
                                if(flag == 0){
                                    return a.new_pass_lv - b.new_pass_lv;
                                }else{
                                    return a.old_pass_lv - b.old_pass_lv;
                                }
                            } else if(cel == 7) {
                                if(flag == 0){
                                    return a.new_next_pass_lv - b.new_next_pass_lv;
                                }else{
                                    return a.old_next_pass_lv - b.old_next_pass_lv;
                                }
                            } else if(cel == 8) {
                                return a.local_lv - b.local_lv;
                            }
                        });
                        $(".glyphicon-sort-by-attributes-alt").each(function(){
                            $(this).removeClass("glyphicon-sort-by-attributes-alt");
                            $(this).addClass("glyphicon-sort-by-attributes");
                        });
                        $(sortTarget).removeClass("glyphicon-sort-by-attributes");
                        $(sortTarget).addClass("glyphicon-sort-by-attributes-alt");
                        container=data;
                        return data;
                    },
                    'sortDESC' : function (data) {
                        container=[];
                        var cel = $(sortTarget).parent().parent().find("th").index($(sortTarget).parent());
                        data.sort(function(a, b) {
                            if(cel == 2) {
                                if(flag == 0){
                                    return b.new_number - a.new_number;
                                }else{
                                    return b.old_number - a.old_number;
                                }
                            } else if(cel == 4) {
                                if(flag == 0){
                                    return b.new_pass_lv - a.new_pass_lv;
                                }else{
                                    return b.old_pass_lv - a.old_pass_lv;
                                }
                            } else if(cel == 7) {
                                if(flag == 0){
                                    return b.new_next_pass_lv - a.new_next_pass_lv;
                                }else{
                                    return b.old_next_pass_lv - a.old_next_pass_lv;
                                }
                            } else if(cel == 8) {
                                return b.local_lv - a.local_lv;
                            }
                        })
                        $(".glyphicon-sort-by-attributes").each(function(){
                            $(this).removeClass("glyphicon-sort-by-attributes");
                            $(this).addClass("glyphicon-sort-by-attributes-alt");
                        })
                        $(sortTarget).removeClass("glyphicon-sort-by-attributes-alt");
                        $(sortTarget).addClass("glyphicon-sort-by-attributes");
                        container=data;
                        return data;
                    }
                }
            })
        }
    });
    /**
     * 省份框点击时 赋予选中效果
     */
    $("#provinceFetch").on("click", "td", function(){
        if($(this).hasClass('fetchbox-active'))
            $(this).removeClass('fetchbox-active');
        else
            $(this).addClass('fetchbox-active');
        return false;
    });
    /**
     * 省份模态框
     */
    $(".glyphicon-th-list").click(function(){
        $("#provinceList").children(".border-shadow").css('position', 'fixed');
        $("#provinceList").children(".border-shadow").css('top', $(this).offset().top - document.documentElement.scrollTop+ 20);
        $("#provinceList").children(".border-shadow").css('left', $(this).offset().left - 300);
        $("#provinceList").fadeIn();
    });
    /**
     * 院校搜索
     */
    $("#search").click(function(){
        window.dispatchEvent( new Event("searchSchool"));
    });
    $("#schoolName").keyup(function() {
        window.dispatchEvent( new Event('searchSchool'));
    });
    /**
     * 省份筛选
     */
    $("#fetch").click(function(){
        // alert(1);
        window.dispatchEvent( new Event('fetchProvince'));
    });
    /**
     * 隐藏自定义modal
     */
    $(".modal-background").click(function () {
        $(this).fadeOut();
    });
    /**
     * 排序
     */
    $("#schoolTable").on("click", ".glyphicon-sort-by-attributes", function(){
        sortTarget = $(this);
        window.dispatchEvent( new Event("sortASC"));
    });

    $("#schoolTable").on("click", ".glyphicon-sort-by-attributes-alt", function(){
        sortTarget = $(this);
        window.dispatchEvent( new Event("sortDESC") );
    });
    /***
     * 选项卡
     */
    $("#mytab li").click(function () {
        $(this).children().addClass('btn-sxp');
        $(this).siblings().children().removeClass('btn-sxp');
        var index = $(this).index();
        if(index == 1){
            flag = 1;
            // $("#schoolTable tr:first-child").children("th:gt(7)").remove();
        }else if(index == 0){
            flag = 2;
            // $("#schoolTable tr:first-child").append(del);
        }
        window.dispatchEvent(new Event("Tab"));
    })
});
