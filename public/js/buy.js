var payway = '<img src="http://localhost/sxp/images/project/rt.png"" style="position:absolute;right:0;bottom:0">';
var notice = $("#notice");
$(function () {
    $("#buy").click(function () {
        $.get(URL+'/buy/get_order',function (response) {
            if(response.status == true){
                $("#order_number").html(response.order_id);
                $("#order_id").val(response.order_id);
                $("#myModal").modal();
            }
        });
    });
    $("#pay div").click(function () {
        var num = $(this).index();
        $(this).addClass('bg_img');
        $(this).siblings().removeClass('bg_img');
        $("#pay_way").val(num);
    });
    $("#pay_button").click(function () {
        var pay_way = $("#pay_way").val();
        if(pay_way == ''){
            notice.html("请选择支付方式！")
            return false;
        }if(pay_way != ''){
            notice.html("&nbsp;");
            if(pay_way == 0){
                return true;
            }if(pay_way == 1){
                $.post(URL+'/buy/pay',
                    {pay_way:pay_way,
                    _token : _token,
                    order_id:$("#order_id").val()},
                    function (response) {
                    if(response.status == true){
                        $("#img").html("<img src=http://paysdk.weixin.qq.com/example/qrcode.php?data="+response.url+">");
                    }
                });
                $("#wepayModal").modal();
                return false;
            }
        }
    })
})