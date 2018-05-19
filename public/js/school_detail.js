$(document).ready(function(){
    $(".tab-content").find("th").addClass('text-center');
    $("th").css('vertical-align', 'middle');


    $("#majorS1").change(function() {
        var classify = $("#majorS1").val();
        var batch = $("#majorS2").val();
        var name = $("#schoolName").html();
        updateMajor(classify, batch, name);
    })


    $("#majorS2").change(function() {
        var classify = $("#majorS1").val();
        var batch = $("#majorS2").val();
        var name = $("#schoolName").html();
        updateMajor(classify, batch, name);
    })

    updateMajor(1, 1, $("#schoolName").html());

})

function updateMajor(classify, batch, name) {
    $.get(URL + '/fill/get_major?classify='+classify+'&batch='+batch+'&name=' + encodeURI(name), function(response) {
        if (!response.status) {
            return;
        }
        var majorData = [];
        for (var i = 0; i < response.data.length; i++) {
            var findSig = false;
            for (var j = 0; j < majorData.length; j++) {
                if (majorData[j].major_name === response.data[i].major_name) {
                    findSig = true;
                    majorData[j].infos[response.data[i].year] = [response.data[i].min_score, response.data[i].differ, response.data[i].number];
                    break;
                }
            }
            if (!findSig) {
                majorData.push({
                    'major_name': response.data[i].major_name,
                    'classify': classify === 1 ? '文科' : '理科',
                    'infos': {
                        '2016': [0, 0, 0],
                        '2015': [0, 0, 0],
                        '2014': [0, 0, 0],
                        '2017': [0],
                    },
                    'spec': '',
                });
                majorData[majorData.length - 1].infos[response.data[i].year] = [response.data[i].min_score, response.data[i].differ, response.data[i].number];
            }
        }
        var str = '';
        for (var k = 0; k < majorData.length; k++) {
            str += '<tr>' +
                    '<td>'+majorData[k].major_name+'</td>'+
                    '<td>'+majorData[k].classify+'</td>'+
                    '<td>'+majorData[k].infos[2016][0]+'</td>'+
                    '<td>'+majorData[k].infos[2016][1]+'</td>'+
                    '<td>'+majorData[k].infos[2016][2]+'</td>'+
                    '<td>'+majorData[k].infos[2015][0]+'</td>'+
                    '<td>'+majorData[k].infos[2015][1]+'</td>'+
                    '<td>'+majorData[k].infos[2015][2]+'</td>'+
                    '<td>'+majorData[k].infos[2014][0]+'</td>'+
                    '<td>'+majorData[k].infos[2014][1]+'</td>'+
                    '<td>'+majorData[k].infos[2014][2]+'</td>'+
                '</tr>'
        }
        $("#majorScore").children().eq(0).children(":gt(1)").remove();
        $("#majorScore").append(str);
    })
}