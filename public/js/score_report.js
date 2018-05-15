var flag = 2015;//年份切换
var original_data;//原始数据
var id=['main','main_school','main_major'];//绘制区域id
var str;//横轴汉字

$(function () {
    $.get(URL+'/Analysis/get_lever',function (response) {
        if(response.status == true){
            original_data = response.data;
            $("#loader").remove();
            display(flag);
            show();
        }
    });
    $("#mytab li").click(function () {
        $(this).children().addClass('btn-sxp');
        $(this).siblings().children().removeClass('btn-sxp');
        var index = $(this).index();
        if (index == 1) {
            flag = 2014;
            display(flag);
            show();
        } else if (index == 0) {
            flag = 2015;
            display(flag);
            show();
        }
    });

    /***
     * 绘制图表
     */
    function painting(id,data,number){
        // alert(number);
        var x = new Array();
        var y = new Array();
        var color = new Array();
        if(number == 0){
            lever=data.score;
        }else if(number == 1){
            lever=data.school;
        }else if(number == 2){
            lever=data.major;
        }
        for(i = 0;i<lever.length;i++){
            color[i] = 'rgb(164,205,238)';
            if(number == 0){
                x[i] = lever[i].score;
                str = '分数';
                if(x[i] == original_data[flag].lever){
                    color[i]='rgb(78,201,142)';
                }
            }else if(number == 1){
                x[i] = lever[i].sch_name;
                str = '院校';
            }else if(number == 2){
                x[i] = lever[i].major_name;
                str = '专业';
            }
            y[i] = lever[i].number;
        }
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById(id));

        // 指定图表的配置项和数据
        var option = {
            color: ['#3398DB'],
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    name : str,
                    nameLocation : 'end',
                    nameTextStyle : {padding: -10},
                    type : 'category',
                    data : x,
                    axisTick: {
                        alignWithLabel: true
                    },
                    axisLabel:{
                        interval:0,//横轴信息全部显示
                        formatter:function(value)
                        {
                            return value.split("").join("\n");
                        }
                    }
                }
            ],
            yAxis : [
                {
                    name : '人数',
                    type : 'value'
                }
            ],
            series : [
                {
                    type:'bar',
                    barWidth: '60%',
                    data: y,
                    itemStyle: {
                        //通常情况下：
                        normal:{
                            //每个柱子的颜色即为colorList数组里的每一项，如果柱子数目多于colorList的长度，则柱子颜色循环使用该数组
                            color: function (params){
                                var colorList = color;
                                return colorList[params.dataIndex];
                            }
                        },
                    },
                }
            ],
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    }

    /**
     * 显示文本方法
     */
    function display(flag) {
        $('h5:eq(0)').html("您的位次："+$("#rank").val());
        $('h5:eq(1)').html("对应"+flag+"年的高考分数："+original_data[flag].lever);
        $('h5:eq(2)').html("1.你的成绩处于什么水平");
        $('h5:eq(3)').html("2."+flag+"年高考成绩和你相近的四川考生都读了什么学校？");
        $('h5:eq(4)').html("3."+flag+"年高考成绩和你相近的四川考生都选择了什么专业？");
    }

    /**
     * 封装显示
     */
    function show() {
        for(j = 0; j < 3; j ++){
            painting(id[j],original_data[flag],j);
        }
    }
});