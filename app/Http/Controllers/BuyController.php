<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/10
 * Time: 10:49
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Model\AccountModel;
use App\Libs\alipay\pagepay\service\AlipayTradeService;
use App\Libs\alipay\pagepay\buildermodel\AlipayTradePagePayContentBuilder;
//use App\Libs\Wxpay\lib\WxPay.Api;
//use App\Libs\Wxpay\example\WxPay.NativePay;
//use App\Libs\Wxpay\example\log;

class BuyController extends Controller
{
    public function get_order(){
        $order_id = session('order_id');
        if($order_id == ''){
            $order_id = date('YmdHis').session()->get("user_id");
            $num = AccountModel::where('user_id',session('user_id'))->update(['order_id'=>$order_id]);
            if($num){
                return response()->json([
                    'status'=>true,
                    'order_id'=>$order_id
                ]);
            }
        }else{
            return response()->json([
                'status'=>true,
                'order_id'=>$order_id
            ]);
        }
    }

    public function pay(Request $request){
        $pay_way = $request->pay_way;
        if($pay_way == 0){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = trim($_POST['order_id']);

            //订单名称，必填
            $subject = '升学派2018届金志愿卡';

            //付款金额，必填
            $total_amount = 280;

            //商品描述，可空
            //$body = trim($_POST['WIDbody']);

            $payRequestBuilder = new AlipayTradePagePayContentBuilder();
            //$payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            //
            $aop = new AlipayTradeService();
            //
            //        /**
            //         * pagePay 电脑网站支付请求
            //         * @param $builder 业务参数，使用buildmodel中的对象生成。
            //         * @param $return_url 同步跳转地址，公网可以访问
            //         * @param $notify_url 异步通知地址，公网可以访问
            //         * @return $response 支付宝返回的信息
            //         */
            $response = $aop->pagePay($payRequestBuilder,config('alipay.return_url'),config('alipay.notify_url'));
        }elseif($pay_way == 1){
//            error_reporting(0);
            ini_set('date.timezone','Asia/Shanghai');
            require_once dirname(__FILE__).'/../../Libs/Wxpay/lib/WxPay.Api.php';
            require_once dirname(__FILE__).'/../../Libs/Wxpay/example/WxPay.NativePay.php';
            require_once dirname(__FILE__).'/../../Libs/Wxpay/example/log.php';
            $notify = new \NativePay();
            $input = new \WxPayUnifiedOrder();
            $input->SetBody("升学派金志愿卡");
            $input->SetAttach(session("user_id"));//附加参数
            $input->SetOut_trade_no($_POST['order_id'].time());
//            $input->SetOut_trade_no($_POST['order_number']);
            $input->SetTotal_fee("28000");
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetGoods_tag("升学派金志愿卡");
            $input->SetNotify_url("http://tb.shengxuepai.cn/login/wp");
            $input->SetTrade_type("NATIVE");
            $input->SetProduct_id("001");
            $result = $notify->GetPayUrl($input);
            $url2 = $result["code_url"];
            return response()->json([
                'status'=>true,
                'url'=>$url2
            ]);
        }
    }

    //ajax轮询查看订单状态
    public function state_change(Request $request){
        $order_id = $request->order_id;
        $account = AccountModel::select('user_type','is_pay')
            ->where('order_id', $order_id)->get();
        return response()->json([
            'status'=>true,
            'user_type'=>$account->user_type,
            'is_pay'=>$account->is_pay
        ]);
    }
}