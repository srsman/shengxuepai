/**
 * Created by DXH on 2018/5/3.
 */
    $(function () {
        // var classify;
        // $.post(URL+'/character/get_message',
        //     {_token:_token},
        //     function (response) {
        //         if(response.status == true){
        //             if(response.data.classify == '文科'){
        //                 classify ='Major-choice-w';
        //             }else{
        //                 classify ='Major-choice-l';
        //             }
        //             $("#page").append('<iframe width="100%" height="700"  frameborder="0" scrolling="no" src="http://www.apesk.com/h/go_zy_dingzhi.asp?checkcode=GNBB22LR@JXJZCKCA6&hruserid=18781771686&l="'+classify+
        //                 "&test_name="+response.data.name+"&test_email="+response.data.id+'"></iframe>');
        //             // s = '<iframe width="100%" height="700"  frameborder="0" scrolling="no" src="http://www.apesk.com/h/go_zy_dingzhi.asp?checkcode=GNBB22LR@JXJZCKCA6"'+
        //             //     "&hruserid=18781771686&l="+classify+
        //             //     "&test_name="+response.data.name+"&test_email="+response.data.id+
        //             //     '"></iframe>';
        //             // alert(s);
        //             // $("#page").html(s);
        //         }
        //     }
        // );
        setInterval(get_notice,3000);
        function get_notice() {
            $.post(URL + '/character/get_report',
                {_token : _token},
                function (response) {
                    if(response.status == true) {
                        if (response.data.liangbiao == 'Major-choice-l') {
                            window.location.href = "http://www.apesk.com/major-choice/g3_science/zyxz_report_admin_FROM_STONE_bzy1l.asp?id=" + response.data.report_id;
                        } else if (response.data.liangbiao == 'Major-choice-w') {
                            window.location.href = "http://www.apesk.com/major-choice/g3/zyxz_report_admin_FROM_STONE_bzy1.asp?id=" + response.data.report_id;
                        }
                    }
                },
                "json"
            );
        }
    });
