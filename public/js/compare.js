var compareData = [];
var chart;
var schoolData;

$(document).ready(function() {

    //初始化图表实例
    chart = echarts.init(document.getElementById('charts'));


    $("#addressFetch").click(function() {
        $("#provinceList").children(".border-shadow").css('position', 'fixed');
        $("#provinceList").children(".border-shadow").css('top', $(this).offset().top - document.documentElement.scrollTop+ 20);
        $("#provinceList").children(".border-shadow").css('left', $(this).offset().left - 300);
        $("#provinceList").fadeIn();
    })

    $(".modal-background").click(function() {
        $(this).hide();
    })

    $("#fetch").click(function(){
        window.dispatchEvent( new Event('fetchProvince'));
    })

    $("#provinceFetch").on("click", "td", function(){
        if($(this).hasClass('fetchbox-active'))
            $(this).removeClass('fetchbox-active');
        else
            $(this).addClass('fetchbox-active');
        return false;
    })

    $("#searchSchool").click(function(){
        window.dispatchEvent(new Event('searchSchool'));
    });

    $("#schoolName").keyup(function () {
        window.dispatchEvent(new Event('searchSchool'));
    });

    /**
     * 优化体验，点击搜索框时，默认选中
     */
    $("#schoolName").focus(function () {
        $(this).select();
    });

    //加载数据
    $.get(URL + "/fill/get_school?batch=1&classify=1&simple=1", function(response) {
        if(response.status) {
            $("#schoolList").next().remove();

            $("#schoolList").multiLineTable({
                data: response.data,
                length: 10,
                wheelLength: 3,
                dataHandle: function(data) {

                    var find = false;
                    for(var i = 0; i < compareData.length; i++) {
                        if(compareData[i][0] === data.name) {
                            find = true;
                            break;
                        }
                    }
                    if(find)
                        return  '<tr>' +
                            '<td>'+data.name+'</td>' +
                            '<td>'+data.address+'</td>' +
                            '<td class="text-center"><button class="btn btn-sxp" type="button" style="background-color: #d9534f" addCompare><span class="glyphicon glyphicon-minus"></span></button>' +
                            '<input type="hidden" value="'+data.infos[0]+'"/> ' +
                            '<input type="hidden" value="'+data.infos[1]+'"/> ' +
                            '<input type="hidden" value="'+data.infos[2]+'"/> ' +
                            '</td>' +
                            '</tr>';
                    else
                        return '<tr>' +
                            '<td>'+data.name+'</td>' +
                            '<td>'+data.address+'</td>' +
                            '<td class="text-center"><button class="btn btn-sxp" type="button" addCompare><span class="glyphicon glyphicon-plus"></span></button>' +
                            '<input type="hidden" value="'+data.infos[0]+'"/> ' +
                            '<input type="hidden" value="'+data.infos[1]+'"/> ' +
                            '<input type="hidden" value="'+data.infos[2]+'"/> ' +
                            '</td>' +
                            '</tr>';
                },
                changeOriginal: function () {
                    return schoolData;
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
                    },
                }
            });
        }
    })


    //添加对比时读取隐藏数据 组成数据 调用刷新
    $("#schoolList").on("click", "[addCompare]", function(){
        if($(this).html().indexOf("plus") !== -1) {
            var name = $(this).parent().prev().prev().html();
            var v1 = $(this).next().val();
            var v2 = $(this).next().next().val();
            var v3 = $(this).next().next().val();

            compareData.push(
                [name, v1, v2, v3]
            );
            refreshCharts();
            $(this).html('<span class="glyphicon glyphicon-minus"></span>');
            $(this).css('background-color', '#d9534f');

        } else {
            var name = $(this).parent().prev().prev().html();

            var index;
            for(var i = 0; i < compareData.length; i++) {
                if(compareData[i][0] == name) {
                    index = i;
                    break;
                }
            }

            compareData.splice(index, 1);

            refreshCharts();
            $(this).html('<span class="glyphicon glyphicon-plus"></span>');
            $(this).css('background-color', '');
        }

    })

    //重新向数据库 请求数据
    $("[name='classify']").click(function(){
        var classify = $("[name='classify']:checked").val();
        var batch = $("[name='batch']:checked").val();
        getData(classify, batch);
    })

    $("[name='batch']").click(function(){
        var classify = $("[name='classify']:checked").val();
        var batch = $("[name='batch']:checked").val();
        getData(classify, batch);
    })
})

/**
 * 重新请求数据
 * @param classify
 * @param batch
 */
function getData(classify, batch) {

    $("#schoolList").children().eq(0).children(":gt(1)").remove();
    $("#schoolList").after('<div class="text-center"><div class="loader-box"> <div class="loader"> </div> <p>加载中，请稍候！</p> </div></div>')
    compareData = [];
    refreshCharts();
    $.get(URL + "/fill/get_school?batch="+batch+"&classify="+classify+"&simple=1", function(response) {
        if(response.status) {

            $("#schoolList").next().remove();
            schoolData = response.data;
            window.dispatchEvent( new Event("changeOriginalData"));
        }
    })
}

/**
 * 重新刷新图表
 */
function refreshCharts() {
    var xData = [];
    var yData = [];
    var minV = 1000;

    var option = {

        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:[]
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['2017','2016','2015']
        },
        yAxis: {
            type: 'value'
        },
        series: [
        ]
    }

    chart.setOption(option, true);


    for(var i = 0; i < compareData.length; i++) {
        xData.push(compareData[i][0]);
        yData.push({
            name: compareData[i][0],
            type:'line',
            data: [compareData[i][1], compareData[i][2], compareData[i][3]]
        })
        minV = Math.min(minV, compareData[i][1], compareData[i][2], compareData[i][3]);
    }
    chart.setOption({
        legend: {
            data:xData
        },
        series: yData,
        yAxis: {
            min : minV - 10,
        }
    });
}