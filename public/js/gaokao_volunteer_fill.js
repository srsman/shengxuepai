var data;
var virLeft = 1;
var virRight = 17;
var originalData;

$(document).ready(function(){
    $.get(URL + '/fill/get_school?classify=1&batch=1', function(response) {
        if (response.status == true) {
            originalData = data = response.data;
            init();
        }
    })

    $("#search").click(function(){
        searchBySchoolName($("#schoolName").val());
    })

    $("#schoolName").keyup(function() {
        //if(event.keyCode === 13) {
            searchBySchoolName($("#schoolName").val());
        //}
    })

    /**
     * FireFox浏览器特殊
     */
    document.body.addEventListener("DOMMouseScroll", function(event) {

        if(!$("#listModal").attr('hidden')) {
            if(event.detail > 0) {
                virLeft += 5;
                virRight += 5;
            } else {
                virLeft -= 5;
                virRight -= 5;
            }
            if(virLeft <= 1) {
                virLeft = 1;
                virRight = 17;
            }
            if(virRight >= data.length + 3) {
                virLeft = data.length - 13;
                virRight = data.length + 3;
            }
            $("#schoolTable").children().eq(0).children(":gt(1)").hide();
            $("#schoolTable").children().eq(0).children(":lt("+virRight+"):gt("+virLeft+")").show();

            var percentage = parseInt(virLeft * 100 / (data.length - 14));
            $("#progressBar").css("width", percentage + "%");
        }
    });
})

function init() {
    $("#schoolTable").children().eq(0).children(":gt(1)").remove();
    var str = '';
    for(var i = 0; i < data.length; i++) {
        str += '<tr hidden>' +
            '<td>1%</td>' +
            '<td>' + data[i].name + '</td>' +
            '<td>' + data[i].address + '</td>' +
            '<td>' + data[i].rank + '</td>' +
            '<td>-</td>' +
            '<td>' + data[i].infos[2017][0] + '</td>' +
            '<td>' + data[i].infos[2017][1] + '</td>' +
            '<td>' + data[i].infos[2017][2] + '</td>' +
            '<td>' + data[i].infos[2016][0] + '</td>' +
            '<td>' + data[i].infos[2016][1] + '</td>' +
            '<td>' + data[i].infos[2016][2] + '</td>' +
            '<td>' + data[i].infos[2015][0] + '</td>' +
            '<td>' + data[i].infos[2015][1] + '</td>' +
            '<td>' + data[i].infos[2015][2] + '</td>' +
            '<td>' + data[i].infos[2018][0] + '</td>' +
            '<td>' + data[i].infos[2018][1] + '</td>' +
            '<td><span class="glyphicon glyphicon-heart"></span></td>' +
            '</tr>'
    }
    virLeft = 1;
    virRight = 17;
    str += "<tr hidden class='text-center text-success'><td colspan='17'>到底啦~</td></tr>"
    $("#schoolTable").append(str);
    $("#schoolTable").children().eq(0).children(":lt("+virRight+")").show();

}

function searchBySchoolName(name) {
    data = new Array();
    for(var i = 0; i < originalData.length; i++) {
        if(originalData[i].name.indexOf(name) !== -1) {
            data.push(originalData[i])
        }
    }
    init();
}