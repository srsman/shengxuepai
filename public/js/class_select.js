/***
 * 国家专项数据
 */
var flag = 0;
var original = [[],[],[],[],[],[]];
var container;
var element = $('small').parent();
var index;//索引


$(function () {
    $.get(URL+'/class_select/get',function (response) {
        if(response.status == true){
            for(i = 0;i < response.data.length;i++){
                if(response.data[i].classify == 1){
                    if(response.data[i].batch == '提前批'){
                        original[0].push(response.data[i]);
                    }else if(response.data[i].batch == '本一批'){
                        original[1].push(response.data[i]);
                    }else{
                        original[2].push(response.data[i]);
                    }
                }else if(response.data[i].classify == 2){
                    if(response.data[i].batch == '提前批'){
                        original[3].push(response.data[i]);
                    }else if(response.data[i].batch == '本一批'){
                        original[4].push(response.data[i]);
                    }else{
                        original[5].push(response.data[i]);
                    }
                }
            }
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
                '<td>' + data.zx_line_2015 + '</td>' +
                '<td>' + data.zx_line_2016 + '</td>' +
                '<td>' + data.zx_line_2017 + '</td>' +
                '<td>' + data.zx_rank_2015 + '</td>' +
                '<td>' + data.zx_rank_2016 + '</td>' +
                '<td>' + data.zx_rank_2017 + '</td>' +
                '<td>' + data.zx_plan_2015 + '</td>' +
                '<td>' + data.zx_plan_2016 + '</td>' +
                '<td>' + data.zx_plan_2017 + '</td>' +
                '<td>' + data.normal_line_2015 + '</td>' +
                '<td>' + data.normal_line_2016 + '</td>' +
                '<td>' + data.normal_line_2017 + '</td>' +
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
                if(flag == 0){
                    container = original[index];
                }else if(flag == 1){
                    container = original[index+3];
                }
                return container;
            }
        }
    });
    $("#nav li").click(function () {
        var index = $(this).index();
        if(index == 0){
            flag = 0;
            $("small").html("文科");
        }else if(index == 1){
            flag = 1;
            $("small").html("理科");
        }
    });
    element.click(function () {
        index = $('small').index($(this).children());
        window.dispatchEvent(new Event("Tab"));
        $("#myModal").modal();
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
});