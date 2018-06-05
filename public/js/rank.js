var originalData = [[],[],[],[],[],[],[],[]]; //原始数据
var html;//拼接元素
var show;//展示区域

$(function () {
    $("p").click(function () {
        var index = $("p").index($(this));
        var myModalLabel = $("#myModalLabel");
         var value = $(this).html();
        myModalLabel.html(value);
        show = $("#showTable");
        get_school(index);
    });

    /**
     * js插件处理数据
     * @param data
     */
    function show_school(data,index) {
        $("#schoolTable").multiLineTable({
            data : data,
            length:10,
            wheelLength : 5,
            dataHandle : function(data) {
                if(index == 0){
                    var str = '<tr>' +
                        '<td>' + data.school_name + '</td>' +
                        '<td>' + data.rank + '</td>' +
                        '<td>' + data.province + '</td>' +
                        '<td>' + data.score + '</td>' +
                        '<td>' + data.belong + '</td>' +
                        '<td>' + data.star_rank + '</td>' +
                        '<td colspan="2">' + data.school_rank + '</td>' +
                        '<td>' + data.public + '</td>' +
                        '</tr>';
                }else if(index == 1){
                    var str = '<tr>' +
                        '<td>' + data.school_name + '</td>' +
                        '<td>' + data.rank + '</td>' +
                        '<td>' + data.score + '</td>' +
                        '<td>' + data.rencai + '</td>' +
                        '<td>' + data.yanjiu + '</td>' +
                        '<td>' + data.benke + '</td>' +
                        '<td>' + data.kexue + '</td>' +
                        '<td>' + data.ziran + '</td>' +
                        '<td>' + data.shehui + '</td>' +
                        '<td>' + data.province + '</td>' +
                        '<td>' + data.province_rank + '</td>' +
                        '<td>' + data.leixing + '</td>' +
                        '<td>' + data.ck_leixing1 + '</td>' +
                        '<td>' + data.ck_leixing2 + '</td>' +
                        '</tr>';
                }else if(index == 2){
                    var str = '<tr>' +
                        '<td>' + data.school_name + '</td>' +
                        '<td>' + data.province + '</td>' +
                        '<td>' + data.rank + '</td>' +
                        '<td>' + data.score + '</td>' +
                        '<td>' + data.zb_score + '</td>' +
                        '</tr>';
                }else if(index == 3){
                    var str = '<tr>' +
                        '<td>' + data.school_name + '</td>' +
                        '<td>' + data.province + '</td>' +
                        '<td>' + data.rank + '</td>' +
                        '<td>' + data.score + '</td>' +
                        '<td>' + data.leixing + '</td>' +
                        '<td>' + data.star_ranking + '</td>' +
                        '<td>' + data.cengci + '</td>' +
                        '</tr>';
                }else if(index == 4){
                    var str = '<tr>' +
                        '<td>' + data.school_name + '</td>' +
                        '<td>' + data.rank + '</td>' +
                        '<td>' + data.score + '</td>' +
                        '<td>' + data.rc_score + '</td>' +
                        '<td>' + data.kx_score + '</td>' +
                        '<td>' + data.province + '</td>' +
                        '<td>' + data.province_rank + '</td>' +
                        '<td>' + data.lx + '</td>' +
                        '<td>' + data.lx1 + '</td>' +
                        '<td>' + data.lx2 + '</td>' +
                        '</tr>';
                }else if(index == 5){
                    var str = '<tr>' +
                        '<td>' + data.school_name + '</td>' +
                        '<td>' + data.rank + '</td>' +
                        '<td>' + data.province + '</td>' +
                        '<td>' + data.score + '</td>' +
                        '<td>' + data.lx + '</td>' +
                        '<td>' + data.star_rank + '</td>' +
                        '<td>' + data.cengci + '</td>' +
                        '<td>' + data.xingzhi + '</td>' +
                        '</tr>';
                }else if(index == 6){
                    var str = '<tr>' +
                        '<td>' + data.school_name + '</td>' +
                        '<td>' + data.rank + '</td>' +
                        '<td>' + data.score + '</td>' +
                        '<td>' + data.rc_score + '</td>' +
                        '<td>' + data.kx_score + '</td>' +
                        '<td>' + data.province + '</td>' +
                        '<td>' + data.province_rank + '</td>' +
                        '<td>' + data.lx + '</td>' +
                        '<td>' + data.lx1 + '</td>' +
                        '<td>' + data.lx2 + '</td>' +
                        '</tr>';
                }else if(index == 7){
                    var str = '<tr>' +
                        '<td>' + data.name + '</td>' +
                        '<td>' + data.number + '</td>' +
                        '<td>' + data.rank + '</td>' +
                        '<td>' + data.junyi + '</td>' +
                        '<td>' + data.fenbu + '</td>' +
                        '<td>' + data.class_number + '</td>' +
                        '</tr>';
                }
                return str;
            },
            userHandle : {
                'initSchoolData' : function(originalData) {
                    return originalData;
                },
                /**
                 * 搜索按学校名称
                 * @param originalData
                 * @returns {Array|any[]}
                 */
                'searchSchool' : function(originalData){
                    var name = $("#schoolName").val();
                    var school = [];
                    for(var i = 0; i < originalData.length; i++) {
                        if(originalData[i].school_name.indexOf(name) !== -1) {
                            school.push(originalData[i])
                        }
                    }
                    return school;
                },
                /**
                 * 筛选省份
                 * @param originalData
                 */
                'fetchProvince': function (originalData) {
                    var pro = [];
                    var school = [];
                    $("#provinceFetch").find(".fetchbox-active").each(function () {
                        if ($(this).html().indexOf("gly") === -1)
                            pro.push($(this).html());
                    })
                    if (pro.length !== 0) {
                        for (var i = 0; i < originalData.length; i++) {
                            for (var j = 0; j < pro.length; j++)
                                if (originalData[i].province.indexOf(pro[j]) !== -1) {
                                    school.push(originalData[i]);
                                    break;
                                }
                        }
                    } else {
                        school = originalData;
                    }
                    $(".modal-background").hide();
                    return school;
                },
            }
        });
    }

    /**
     * 各个模块点击事件
     * @param index
     */
    function get_school(index) {
        join_str(index);//拼接表头
        show.html(html);//写表头
        if(originalData[index].length != 0){
            show_school(originalData[index],index);//院校数据展示
            $("#myModal").modal();
        }else if(originalData[index].length == 0){
            $.get(URL+'/rank/get_school?id='+index,function (response) {
                if(response.data){
                    originalData[index] = response.data;
                    show_school(originalData[index],index);//院校数据展示
                    $("#myModal").modal();
                }
            })
        }
    }

    /**
     * 拼接表头
     * @param index
     * @returns {string|*}
     */
    function join_str(index) {
        if(index == 0){
            html = '<table class="table table-striped table-bordered text-center" id="schoolTable"><tr>' +
                '<th>'+
                '<div class="input-group">' +
                '<input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">' +
                '<div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div></div>' +
                '</th>' +
                '<th></th><th></th><th></th><th></th><th></th><th colspan="2"></th><th></th></tr>' +
                '<tr><th class="text-center">学校名称</th><th class="text-center">院校排名</th><th class="text-center">所在地&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th><th class="text-center">总分</th><th class="text-center">办学类型</th><th class="text-center">星级排名</th><th colspan="2" class="text-center">办学层次</th><th class="text-center">办学性质</th>' +
                '</tr></table>';
        }else if(index == 1){
            html = '<table class="table table-striped table-bordered text-center" id="schoolTable"><tr>' +
                '<th>'+
                '<div class="input-group">' +
                '<input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">' +
                '<div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div></div>' +
                '</th>' +
                '<th></th><th></th><th colspan="3" class="text-center">人才培养</th><th colspan="3" class="text-center">科学研究</th><th colspan="2" class="text-center">分省排名</th><th></th><th colspan="2" class="text-center">学校参考类型</th></tr>' +
                '<tr><th class="text-center">院校名称</th><th class="text-center">院校排名</th><th class="text-center">总得分</th><th class="text-center">人才培养</th><th class="text-center">研究生培养</th><th class="text-center">本科生培养</th><th class="text-center">科学研究</th><th class="text-center">自然科学研究</th><th class="text-center">社会科学研究</th><th class="text-center">所在省份&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th><th class="text-center">排名</th><th class="text-center">院校类型</th><th class="text-center">类型1</th><th class="text-center">类型2</th>' +
                '</tr></table>';
        }else if(index == 2){
            html = '<table class="table table-striped table-bordered text-center" id="schoolTable"><tr>' +
                '<th>'+
                '<div class="input-group">' +
                '<input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">' +
                '<div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div></div>' +
                '</th>' +
                '<th></th><th></th><th></th><th></th></tr>' +
                '<tr><th class="text-center">院校名称</th><th class="text-center">所在省份&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th><th class="text-center">排名</th><th class="text-center">总分</th><th class="text-center">指标得分</th>' +
                '</tr></table>';
        }else if(index == 3){
            html = '<table class="table table-striped table-bordered text-center" id="schoolTable"><tr>' +
                '<th>'+
                '<div class="input-group">' +
                '<input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">' +
                '<div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div></div>' +
                '</th>' +
                '<th></th><th></th><th></th><th></th><th></th><th></th></tr>' +
                '<tr><th class="text-center">院校名称</th><th class="text-center">所在省份&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th><th class="text-center">排名</th><th class="text-center">总分</th><th class="text-center">办学类型</th><th class="text-center">星级排名</th><th class="text-center">办学层次</th>' +
                '</tr></table>';
        }else if(index == 4){
            html = '<table class="table table-striped table-bordered text-center" id="schoolTable"><tr>' +
                '<th>'+
                '<div class="input-group">' +
                '<input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">' +
                '<div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div></div>' +
                '</th>' +
                '<th></th><th></th><th></th><th></th><th colspan="2" class="text-center">分省排名</th><th></th><th colspan="2" class="text-center">学校参考类型</th></tr>' +
                '<tr><th class="text-center">院校名称</th><th class="text-center">排名</th><th class="text-center">总分</th><th class="text-center">人才培养得分</th><th class="text-center">科学研究得分</th><th class="text-center">省份&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th><th class="text-center">排名</th><th class="text-center">学校类型</th><th class="text-center">类型1</th><th class="text-center">类型2</th>' +
                '</tr></table>';
        }else if(index == 5){
            html = '<table class="table table-striped table-bordered text-center" id="schoolTable"><tr>' +
                '<th>'+
                '<div class="input-group">' +
                '<input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">' +
                '<div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div></div>' +
                '</th>' +
                '<th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>' +
                '<tr><th class="text-center">院校名称</th><th class="text-center">排名</th><th class="text-center">所在省份&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th><th class="text-center">总分</th><th class="text-center">办学类型</th><th class="text-center">星级排名</th><th class="text-center">办学性质</th><th class="text-center">办学层次</th>' +
                '</tr></table>';
        }else if(index == 6){
            html = '<table class="table table-striped table-bordered text-center" id="schoolTable"><tr>' +
                '<th>'+
                '<div class="input-group">' +
                '<input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">' +
                '<div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div></div>' +
                '</th>' +
                '<th></th><th></th><th></th><th></th><th colspan="2" class="text-center">分省排名</th><th></th><th colspan="2" class="text-center">学校参考类型</th></tr>' +
                '<tr><th class="text-center">院校名称</th><th class="text-center">排名</th><th class="text-center">总分</th><th class="text-center">人才培养得分</th><th class="text-center">科学研究得分</th class="text-center"><th class="text-center">省份&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th><th class="text-center">排名</th><th class="text-center">学校类型</th><th class="text-center">类型1</th><th class="text-center">类型2</th>' +
                '</tr></table>';
        }else if(index == 7){
            html = '<table class="table table-striped table-bordered text-center" id="schoolTable"><tr>' +
                '<th>'+
                '<div class="input-group">' +
                '<input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">' +
                '<div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div></div>' +
                '</th>' +
                '<th></th><th></th><th></th><th></th><th></th></tr>' +
                '<tr><th class="text-center">院校名称</th><th class="text-center">院校代码</th><th class="text-center">学科综合排名</th><th class="text-center">学科均谊</th><th class="text-center">七大类分布数</th><th class="text-center">参评学科数</th>' +
                '</tr></table>';
        }
        return html;
    }
    /**
     * 院校搜索
     */
    $("body").on("click","#search",function(){
        window.dispatchEvent( new Event("searchSchool"));
    });
    $("body").on("keyup","#schoolName",function() {
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
    $("body").on("click",'.glyphicon-th-list',function(){
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
});