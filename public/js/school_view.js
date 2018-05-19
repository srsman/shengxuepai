/**
 * 目标大学查询
 * 作者：gscsdlz
 * 时间：2018-4-14
 *
 *
 */
/**
 * attr_num是基于位运算的结果 请查看数据库文档
 */
var attr_num;
var level;

$(document).ready(function(){
    $(".sxp-footer").removeClass("navbar-fixed-bottom");

    $.get( URL + "/school/get", function(response){
        $('.loader-box').remove();
        if(response.status == true) {
            $("#schoolInfo").multiLineTable({
                data : response.data,
                length : 10,
                wheelLength : 3,
                dataHandle : function(d) {
                    var str = '<tr>' +
                        '<td schoolName style="cursor: pointer">'+d.name+'</td>' +
                        '<td>'+(d.ranking_1 == null ? '-' : d.ranking_1)+'</td>' +
                        '<td>'+(d.ranking_3 == null ? '-' : d.ranking_3)+'</td>' +
                        '<td>'+d.province + '-' + d.city +'</td>' +
                        '<td>'+d.level +'</td>' +
                        '<td>'+d.public + '</td>' +
                        '<td>'+((d.attr_num & (1 << 7)) ? '一流学科' : ((d.attr_num & (1 << 8)) ? '一流大学' : ''))+'</td>' +
                        ((d.attr_num & (1 << 6)) ? '<td class="ok-gly"><span class="glyphicon glyphicon-ok"></span></td>' : '<td></td>') +
                        ((d.attr_num & (1 << 5)) ? '<td class="ok-gly"><span class="glyphicon glyphicon-ok"></span></td>' : '<td></td>') +
                        ((d.attr_num & (1 << 4)) ? '<td class="ok-gly"><span class="glyphicon glyphicon-ok"></span></td>' : '<td></td>') +
                        ((d.attr_num & (1 << 3)) ? '<td class="ok-gly"><span class="glyphicon glyphicon-ok"></span></td>' : '<td></td>') +
                        ((d.attr_num & (1 << 2)) ? '<td class="ok-gly"><span class="glyphicon glyphicon-ok"></span></td>' : '<td></td>') +
                        ((d.attr_num & (1 << 1)) ? '<td class="ok-gly"><span class="glyphicon glyphicon-ok"></span></td>' : '<td></td>') +
                        ((d.attr_num & (1 << 0)) ? '<td class="ok-gly"><span class="glyphicon glyphicon-ok"></span></td>' : '<td></td>') +
                        '</tr>';
                    return str;
                },
                userHandle : {
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
                                    if (originalData[i].province.indexOf(pro[j]) !== -1) {
                                        data.push(originalData[i]);
                                        break;
                                    }
                            }
                        } else {
                            data = originalData;
                        }
                        $(".modal-background").hide();

                        return data;
                    },

                    /**
                     * 筛选一些属性
                     */
                    'fetchAttr' : function (originalData) {
                        var data = [];
                        for (var i = 0; i <originalData.length; i++) {
                            if(originalData[i].attr_num & attr_num) {
                                data.push(originalData[i]);
                            } else if(level == 1 && originalData[i].level == '教育部') {
                                data.push(originalData[i]);
                            }
                        }
                        if(attr_num == 0 && level == 0)
                            return originalData;
                        return data;
                    }
                },
            })
        } else {

        }
    })

    $("#searchSchool").click(function(){
        window.dispatchEvent(new Event('searchSchool'));
    })

    $("#schoolName").keyup(function () {
        window.dispatchEvent(new Event('searchSchool'));
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

    $(".custom-checkbox").click(function(){
        var selected = [0,0,0,0];
        $(".custom-checkbox").each(function(index){
            if($(this).css('background-position') === '-10px -218px')
                selected[index] = 1;
        })
        attr_num = 0;
        if(selected[0] === 1) {//双一流
            attr_num |= 3 << 7; //1 1000 0000
        }
        if(selected[1] === 1) { //985
            attr_num |= 1 << 6; //0 0100 0000
        }
        if(selected[2] === 1) {
            attr_num |= 1 << 5; //0 0010 0000
        }
        level = selected[3];

        window.dispatchEvent(new Event("fetchAttr"));
    })

    $("#schoolInfo").on('click', '[schoolName]', function(){
        var name = $(this).html();
        window.location.href = URL + '/school/detail?name=' + encodeURI(name);
    })

})