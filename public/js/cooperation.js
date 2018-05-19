var majorData;//异步返回的院校专业数据
var All_Major_Data = [];//储存所有已请求的专业数据

/**
 * 中外合作办学
 */

$(document).ready(function () {
    $.get(URL+'/cooperation/get_school',function (response) {
        if(response.status==true){
            $("#schoolTable").multiLineTable({
                data:response.data,
                length:10,
                wheelLength : 5,
                dataHandle:function (data) {
                    var str = '<tr>'+
                    '<td>' + data.name + '</td>'+
                    '<td>' + data.address+'</td>' +
                    '<td>' + data.ranking + '</td>' +
                    '<td>' + data.zs_xs + '</td>' +
                    '<td>' + (data.new_dd === 0 ? '-' : data.new_dd) + '</td>' +
                    '<td>' + (data.new_rank === 0 ? '-' : data.new_rank) + '</td>' +
                    '<td>' + (data.new_number === 0 ? '-' : data.new_number) + '</td>' +
                    '<td>' + (data.next_dd === 0 ? '-' : data.next_dd) + '</td>' +
                    '<td>' + (data.next_rank === 0 ? '-' : data.next_rank) + '</td>' +
                    '<td>' + (data.next_number === 0 ? '-' : data.next_number) + '</td>' +
                    '<td>' + (data.last_dd === 0 ? '-' : data.last_dd) + '</td>' +
                    '<td>' + (data.last_rank === 0 ? '-' : data.last_rank) + '</td>' +
                    '<td>' + (data.last_number === 0 ? '-' : data.last_number) + '</td>' +
                    '<td>-</td>' +
                    '<td style="padding: 2px"><button class="btn btn-default" data-toggle="modal" data-target="#myModal" id="' + data.id + '">查看</button></td>' +
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
                        container='';
                        var name = $("#schoolName").val();
                        var data = [];
                        for(var i = 0; i < originalData.length; i++) {
                            if(originalData[i].name.indexOf(name) !== -1) {
                                data.push(originalData[i])
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
                        container='';
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
                    }
                }
            })
        }
    });
    /**
     * 中外合作办学专业展示方式
     */
    $("#majorTable").multiLineTable({
        data : [],
        length:10,
        wheelLength : 5,
        dataHandle : function(data) {
            var str = '<tr>' +
                '<td>' + data.major_name + '</td>' +
                '<td>' + data.zs_xs + '</td>' +
                '<td>' + data.new_min_score + '</td>' +
                '<td>' + data.new_wc + '</td>' +
                '<td>' + (data.new_number === 0 ? '-' : data.new_number) + '</td>' +
                '<td>' + (data.next_min_score === 0 ? '-' : data.next_min_score) + '</td>' +
                '<td>' + (data.next_wc === 0 ? '-' : data.next_wc) + '</td>' +
                '<td>' + (data.next_number === 0 ? '-' : data.next_number) + '</td>' +
                '<td>' + (data.last_min_score === 0 ? '-' : data.last_min_score) + '</td>' +
                '<td>' + (data.last_wc === 0 ? '-' : data.last_wc) + '</td>' +
                '<td>' + (data.last_number === 0 ? '-' : data.last_number) + '</td>' +
                '<td>' + data.school + '</td>' +
                '<td>' + (data.tuition === 0 ? '-' : data.tuition) + '</td>' +
                '</tr>';
            return str;
        },
        userHandleLocal : {
            'initMajorData' : function(originalData) {
                return majorData;
            }
        }
    });
    /**
     * 点击查看按钮
     */
    $("#schoolTable").on("click","button", function () {
        var id = $(this).attr("id");
        var name = $(this).parent().prevAll("td:last").html();
        $.get(URL + '/cooperation/get_major?id=' + id, function (response) {
            if (response.status == true) {
                $("#myModalLabel").html(name);
                majorData = response.data;
            }
            /**
             * 初始化数据
             */
            window.dispatchEvent(new Event('initMajorData'));
        });
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
    /**
     * 省份筛选
     */
    $("#fetch").click(function(){
        window.dispatchEvent( new Event('fetchProvince'));
    });
    /**
     * 隐藏自定义modal
     */
    $(".modal-background").click(function () {
        $(this).fadeOut();
    });
});
