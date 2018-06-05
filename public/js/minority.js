/***
 * 少数民族预科
 */
var flag = 0;
var original = [[],[]];
var container;
var batch;//批次

$(function () {
    $.get(URL+'/minority/get',function (response) {
        if(response.status == true){
            for(i = 0; i <response.data.length; i++){
                if(response.data[i].classify == 1){
                    original[0].push(response.data[i]);
                }else if(response.data[i].classify == 2){
                    original[1].push(response.data[i]);
                }
            }
            flag_set();
            $("#schoolTable").multiLineTable({
                data: container,
                length: 8,
                wheelLength: 3,
                dataHandle: function (data) {
                    var str = '<tr>' +
                        '<td>' + data.school_name + '</td>' +
                        '<td>' + data.batch + '</td>' +
                        '<td>' + data.province + '</td>' +
                        '<td>' + data.yuke_score_2015 + '</td>' +
                        '<td>' + data.yuke_score_2016 + '</td>' +
                        '<td>' + data.yuke_score_2017 + '</td>' +
                        '<td>' + data.yuke_rank_2015 + '</td>' +
                        '<td>' + data.yuke_rank_2016 + '</td>' +
                        '<td>' + data.yuke_rank_2017 + '</td>' +
                        '<td>' + data.plan_2017 + '</td>' +
                        '<td>' + data.plan_2017 + '</td>' +
                        '<td>' + data.plan_2017 + '</td>' +
                        '<td>' + data.no_yuke_2015 + '</td>' +
                        '<td>' + data.no_yuke_2016 + '</td>' +
                        '<td>' + data.no_yuke_2017 + '</td>' +
                        '</tr>';
                    return str;
                },
                userHandle : {
                    /**
                     * 初始化事件 用于重置指针
                     * @param data
                     * @returns {*}
                     */
                    'initData': function (originalData) {
                        return container;
                    },
                    /**
                     * 搜索按学校名称
                     * @param originalData
                     * @returns {Array|any[]}
                     */
                    'searchSchool' : function(originalData){
                        var name = $("#schoolName").val();
                        var data = [];
                        for(var i = 0; i < container.length; i++) {
                            if(container[i].school_name.indexOf(name) !== -1) {
                                data.push(container[i]);
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
                        });
                        if (pro.length !== 0) {
                            data = [];
                            for (var i = 0; i < container.length; i++) {
                                for (var j = 0; j < pro.length; j++)
                                    if (container[i].province.indexOf(pro[j]) !== -1) {
                                        data.push(container[i]);
                                        break;
                                    }
                            }
                        } else {
                            data = container;
                        }
                        $(".modal-background").hide();
                        return data;
                    },
                    /***
                     * 选项卡
                     */
                    'Tab':function (originalData) {
                        flag_set();
                        return container;
                    },
                    /**
                     * 批次选择
                     */
                    'batch':function (originalData) {
                        var data = [];
                        for(var i = 0; i < container.length; i++) {
                            if(container[i].batch.indexOf(batch) !== -1) {
                                data.push(container[i]);
                            }
                        }
                        if(data.length == 0){
                            data = container;
                        }
                        return data;
                    }
                }
            });
            $("#loader").remove();
        }
    });

    function flag_set() {
        if(flag == 0){
            container = original[0];
        }else if(flag == 1){
            container = original[1];
        }
    }

    /***
     * 原始数据
     */
    $("#nav li").click(function () {
        var index = $(this).index();
        if(index == 0){
            flag = 0;
        }else if(index == 1){
            flag = 1;
        }
        window.dispatchEvent(new Event("Tab"));
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
        window.dispatchEvent( new Event('fetchProvince'));
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
     * 隐藏自定义modal
     */
    $(".modal-background").click(function () {
        $(this).fadeOut();
    });
    /**
     * 批次选择
     */
    $("#batch li a").click(function () {
        batch = $(this).html();
        window.dispatchEvent(new Event('batch'));
    })
});