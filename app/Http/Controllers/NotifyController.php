<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/23
 * Time: 15:42
 */

namespace App\Http\Controllers;

use App\Libs\alipay\pagepay\service\AlipayTradeService;
use Illuminate\Support\Facades\Session;

class NotifyController extends Controller
{
    //支付宝支付跳转
    public function alipay(){
        $arr=$_GET;
        $alipaySevice = new AlipayTradeService();
        $result = $alipaySevice->check($arr);
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);

//            echo "验证成功<br />支付宝交易号：".$trade_no;
            $data=substr($out_trade_no,14);
            Session::put('name', $data);

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            $this->getView()->assign('type',1);
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
//            echo "验证失败";
            $this->getView()->assign('type',0);
        }
        $this->display('tz');
    }
    //支付宝异步回调
    public function state_changeAction()
    {
        $arr = $_POST;
        $alipaySevice = new AlipayTradeService();
        $alipaySevice->writeLog(var_export($_POST, true));
        $result = $alipaySevice->check($arr);
        if ($result) {
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];

            if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                $login = LoginModel::Instance();
                $user = $login->query("update s_account set user_type = 1,is_pay = 1,vip=1,time_limit = 18 where order_id='" . $out_trade_no . "'");
            }
            echo "success";    //请不要修改或删除
        } else {
            //验证失败
            echo "fail";
        }
    }
}