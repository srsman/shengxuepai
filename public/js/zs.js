/**
 * 自主招生
 */
var data;
var originalDate;

$(document).ready(function () {
    $.get(URL+'/zs/get_school',function (response) {
        if(response.status==true){
            if(response.data.length>0){
                originalDate = data=response.data;
                init();
            }else{
                notice();
            }
        }
    },'json')
});

function init() {
    var html='<tbody>';
    for(i=0;i<data.length;i++){
        html+='<tr><td>'+data[i].province+'</td><td>'+data[i].school_name+'</td><td>'+data[i].infos[2017][0]+'</td><td>'
            +data[i].infos[2017][1]+'</td><td>'+data[i].infos[2017][2]+'</td><td>'
            +data[i].infos[2017][3]+'</td><td>'+data[i].infos[2017][4]+'</td><td>'+data[i].infos[2017][5]+'</td><td>'
            +data[i].infos['teacher'][0]+'</td><td>'+data[i].infos['teacher'][1]+'</td><td>'+data[i].infos['teacher'][2]+'</td>';
    }
    html+='</tbody>';
    $("#show").append(html);
}

function notice() {
    var html='';
    html+='<tbody><tr><td>无</td></tr></tbody>';
    $("#show").append(html);
}