/**
 * Created by DXH on 2018/5/3.
 */
    $(function () {
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
