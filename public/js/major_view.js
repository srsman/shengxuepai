/**
 * major_view 目标专业查询js
 * 完成时间：2018-04-11
 * 修改日志：暂无
 * 作者：gscsdlz
 */

var data = [
    [],  //本科
    []   //专科
];


/**
 * data = [
 *   [
 *       id123456: {
 *           name: '工学',
 *           list : {
 *               id12345 : {
 *                   name : '计算机类',
 *                   list : [
 *                       {
 *                           name: '计算机科学与技术',
 *                           code: 123,
 *                           url_1: www....
 *                           url_2: www....
 *                       },
 *                       {
 *                          ....
 *                       }
 *                   ]
 *               },
 *               id12346 : {
 *                   ...
 *               }
 *           }
 *       }
 *   ]
 * ]
 */
var bz;  //本专科选项

$(document).ready(function () {
    //取消由于之前设置了页脚固定带来的遮盖
    $(".sxp-footer").removeClass("navbar-fixed-bottom");

    $.get(URL + "/major/get", function(response){
        if(response.status) {
            for(var i = 0; i < response.data.length; i++) {
              if(response.data[i].pid === 0) {  //第一类
                  data[response.data[i].bz - 1]["id" + response.data[i].id] = {
                      name : response.data[i].name,
                      list : {},
                  } ;
              } else if(response.data[i].url_1 == 0) {  //第二类
                  data[response.data[i].bz - 1]["id" + response.data[i].pid].list["id" + response.data[i].id] = {
                      name : response.data[i].name,
                      list : [],
                  }
              } else {  //最后一类
                  data[response.data[i].bz - 1]["id" + (response.data[i].pid.toString().substr(0, 6))].list["id" + response.data[i].pid].list.push({
                      name : response.data[i].name,
                      url_1 : response.data[i].url_1,
                      url_2 : response.data[i].url_2,
                      code : response.data[i].code,
                  })
              }
            }
            //取消加载显示
            $("#loader").remove();

            //先更新专科，再更新本科，避免页面不显示
            bz = 1;
            changeCategory_1();
            bz = 0;
            changeCategory_1();
        }
    })

    //设置bz的值
    $("#li_1").click(function(){
        bz = 0;
    })

    $("#li_2").click(function(){
        bz = 1;
    })

    //级联操作，下同
    $("#bz-0").on("click", "[category_1_0]", function () {
        //取消激活样式
        $(this).parent().find('.glyphicon-play').remove();
        $(this).parent().find('.sxp-list-group-active').removeClass('sxp-list-group-active');

        //设置激活样式
        $(this).html($(this).html() + '<span style="float:right;color:gray" class="glyphicon glyphicon-play"></span>');
        $(this).addClass('sxp-list-group-active');
        //抽取id
        var id = $(this).attr("category_1_0");
        //刷新
        changeCategory_2(id);


        backTop();
    })

    $("#bz-0").on("click", "[category_2_0]", function () {
        $(this).parent().find('.glyphicon-play').remove();
        $(this).parent().find('.sxp-list-group-active').removeClass('sxp-list-group-active');

        $(this).html($(this).html() + '<span style="float:right;color:gray" class="glyphicon glyphicon-play"></span>');
        $(this).addClass('sxp-list-group-active');
        var id = $(this).attr("category_2_0");
        changeCategory_3(id);

        backTop();
    })


    $("#bz-1").on("click", "[category_1_1]", function () {
        $(this).parent().find('.glyphicon-play').remove();
        $(this).parent().find('.sxp-list-group-active').removeClass('sxp-list-group-active');

        $(this).html($(this).html() + '<span style="float:right;color:gray" class="glyphicon glyphicon-play"></span>');
        $(this).addClass('sxp-list-group-active');
        var id = $(this).attr("category_1_1");
        changeCategory_2(id);

        backTop();
    })

    $("#bz-1").on("click", "[category_2_1]", function () {
        $(this).parent().find('.glyphicon-play').remove();
        $(this).parent().find('.sxp-list-group-active').removeClass('sxp-list-group-active');

        $(this).html($(this).html() + '<span style="float:right;color:gray" class="glyphicon glyphicon-play"></span>');
        $(this).addClass('sxp-list-group-active');
        var id = $(this).attr("category_2_1");
        changeCategory_3(id);

        backTop();
    })

})

//类别一更新
function changeCategory_1() {
    var that = $("#bz-" + bz).children().eq(0);
    var str = '';

    var firstID = '';

    for(var row in data[bz]) {
        if(firstID === '') {
            firstID = row;
        }
        if(bz === 0)
            str += '<li category_1_0="'+row+'" class="list-group-item sxp-list-group">' + data[bz][row].name +'</li>';
        else
            str += '<li category_1_1="'+row+'" class="list-group-item sxp-list-group">' + data[bz][row].name +'</li>';
    }
    $(that).children().eq(0).children().eq(0).html(str);
    $(that).children().eq(0).children().eq(0).children().eq(0).addClass('sxp-list-group-active');
    $(that).children().eq(0).children().eq(0).children().eq(0).html($(that).children().eq(0).children().eq(0).children().eq(0).html() + '<span style="float:right;color:gray" class="glyphicon glyphicon-play"></span>');

    changeCategory_2(firstID);
}

//类别二更新
function changeCategory_2(id) {
    var that = $("#bz-" + bz).children().eq(0);
    var str = '';
    var firstID = '';

    for(var row in data[bz][id].list) {
        if(firstID === '') {
            firstID = row;
        }
        if(bz == 0)
            str += '<li category_2_0="'+row+'" class="list-group-item sxp-list-group">' + data[bz][id].list[row].name +'</li>';
        else
            str += '<li category_2_1="'+row+'" class="list-group-item sxp-list-group">' + data[bz][id].list[row].name +'</li>';
    }
    $(that).children().eq(1).children().eq(0).html(str);
    $(that).children().eq(1).children().eq(0).children().eq(0).addClass('sxp-list-group-active');
    $(that).children().eq(1).children().eq(0).children().eq(0).html($(that).children().eq(1).children().eq(0).children().eq(0).html() + '<span style="float:right;color:gray" class="glyphicon glyphicon-play"></span>');

    changeCategory_3(firstID);
}

//类别三更新
function changeCategory_3(id) {

    var that = $("#bz-" + bz).children().eq(0);
    var str = '';
    pid = id.substr(0, 8);
    str = '<table class="table table-hover">' +
            '<tr>' +
                '<th style="width:40%">专业名称</th>' +
                '<th style="width:20%">专业代码</th>' +
                '<th style="width:20%">专业简介</th>' +
                '<th style="width:20%">开设院校</th>' +
            '</tr>';
    for(var row in data[bz][pid].list[id].list) {
        str += '<tr>' +
                    '<td>'+data[bz][pid].list[id].list[row].name+'</td>' +
                    '<td>'+data[bz][pid].list[id].list[row].code+'</td>' +
                    '<td><a class="btn btn-sm btn-sxp" target="_blank" href="http://gaokao.chsi.com.cn/'+data[bz][pid].list[id].list[row].url_1+'">查看</a></td>' +
                    '<td><a class="btn btn-sm btn-sxp" target="_blank" href="http://gaokao.chsi.com.cn/'+data[bz][pid].list[id].list[row].url_2+'">查看</a></td>' +
                '</tr>'
    }
    str += '<table>'
    $(that).children().eq(2).children().eq(0).html(str);
}