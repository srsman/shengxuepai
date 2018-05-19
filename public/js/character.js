$(function () {
    $('[data-toggle="modal"]').click(function () {
        $.get(URL + '/character/get_report',function (response) {
            if(response.status == true){
                if(response.data.liangbiao=='Major-choice-l'){
                    $("#link").attr('href','http://www.apesk.com/major-choice/g3_science/zyxz_report_admin_FROM_STONE_bzy1l.asp?id=' + response.data.report_id);
                }else if(response.data.liangbiao=='Major-choice-w'){
                    $("#link").attr('href','http://www.apesk.com/major-choice/g3_science/zyxz_report_admin_FROM_STONE_bzy1.asp?id=' + response.data.report_id);
                }
                $("#myModal").modal();
            }else if(response.status == false){
                window.location=URL+'/testing';
            }
        });
    })
})