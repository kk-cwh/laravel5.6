<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/4/27
 * Time: 下午3:15
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;

class WeChatController extends  Controller
{

    // 统一下单
    public function order()
    {
        Log::info('request arrived.');
        $payment = \EasyWeChat::payment(); // 微信支付
        $result = $payment->order->unify([
            'body' => '测试',
            'out_trade_no' => date('YmdHis').'123132131232',
            'total_fee' => 1,
//            'spbill_create_ip' => '123.12.12.123', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
//            'notify_url' => 'https://pay.weixin.qq.com/wxpay/pay.action', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'JSAPI',
            'openid' => 'o-BNduLXMqLGrWjm684sd-vjcufs',
        ]);
        $jssdk = $payment->jssdk;
        $json = $jssdk->bridgeConfig(array_get($result,'prepay_id'));
         return view('pay',compact('json'));

    }
}