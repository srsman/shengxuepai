/***
 * 少数民族预科
 */
var flag = 0;
var container = [];
var wen = [];
var li = [];


$(function () {
    $.get(URL+'/minority/get',function (response) {
        if(response.status == true){
            for(i = 0; i <response.data.length; i++){
                if(response.data[i].classify == 1){
                    wen.push(response.data[i]);
                }else if(response.data[i].classify == 2){
                    li.push(response.data[i]);
                }
            }
            container = wen;
            $("#loader").remove();
        }
    });
    $("#schoolTable").multiLineTable({
            data: container,
            length: 10,
            wheelLength: 5,
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
                    });
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
                    if(flag == 0){
                        container = wen;
                    }else if(flag == 1){
                        container = li;
                    }
                    return container;
                }
            }
    });

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
    })
});