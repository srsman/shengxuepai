<?php
/**
 * Created by PhpStorm.
 * User: UI
 * Date: 2018/5/22
 * Time: 14:39
 */
return [
    //应用ID,您的APPID。
    'app_id' => "2017111309913834",

    //商户私钥
    'merchant_private_key' => "MIIEpQIBAAKCAQEAsI0WO+zmGgwxCSHc/pZ4w1X12e3WoIGOZhOBvr5utU2j8QcOaue9Y39SXJ/Q9ke6gxJvLjKlpzy4+V1hCeG17gQ4qCoMd1/svcBKLYmFrlaDDQmswf885EstISEtxyOQTCC4e0BV0vOcBu63weXYihUCMcQXviVaIOlAEyR/afN31BXByar+1vi93GWaBtYVYDo/7RstjAXUsCSSlxjKd8d1/NaglCYXtmzpYITF1ZmhgMBs9lSa/MaGN0wxsWX+LwbkZC84WRqf/3X1wLvI9rXxF+z8WX00uMqSUw6/jvI4xndLG2cQ4xCj1BZn1eNdSSeTCElWesi6i0izgMgsfwIDAQABAoIBAQCBLmqzZE6lhoAmr3l1awJn4zDlyco+XS2lcOaBe/Ojg3DOfpxFCtWfxNyt215ZpfhJyaZCRlrBOIQcKgBD67xjsQEHwuSmQDEIUne0RCjlfHWdh5O5yxlx7bPSxuUpDdOacGKsBFIH7aofxHH+VUCRIHgfk9zPi6Mb66+vkggMrBoA982ygCKJ7TRqHVy//2hMgqk6fBO4HirA+YCv1P/Avbm6FwauRAXLnn3T4ra1MDcDMvwyY1nvvrQR/i9gTE1RBgflehIkyMWypk3CbKYQ/szwpoURpi6RkeTgCEqMLOdQLhzzEm/msUg9NrdAYY13mS6X/L2AFYJvrsveCsCxAoGBAOQjEIlYcW08UBoIkNgKLkI7PQc/Od3xAgwaMdiDatcru8eRNMyeDkYWtgWb923/4dHz5IqA33aajCCKa6X8VVxs0QLS3M60Ii5sn7xNd57BN/z8AY3dnoChNXR524X9s4OU+iKyT/SZDJda+9duxf/J1YRvYirnNN6V9DlHk4ZJAoGBAMYdI1DTw9I+O85lO7qISkUv8FHKgPx48HmCnaig8IIoh+2xrOVigpb4lXqG1z85fwHkAW8VzxsWuK/o3B47cDG0slxbcKRB2u9SNUvxybjtNWchm6zLbd3TMWwEGu/JNOiu6+O7+YY7b2sQepjSOSn2okdO0seXbTdHWbNxaXyHAoGBAKWBjsilYjyGSfJpDnO9BwxDn6W3R8rswrh29HyH8qXBc4x3mp9rdx1/8nOlT978iR5g2wdkMToBKvGcmjYkFuVjiEqNIWXQJxAY+9WHOeXxdSXSyWnbQtc8nOQwV4Mgp/Aoz0MGq5zev9S6TARht8E28vEOQWCwtZlZnoFDnRIJAoGAEOkHzKxmuJlrTXDCqmdbv5AZ+UFJxUMlc5m8j1o9bT68a4OQ+HtyHiTVzYGY+eKUfrrRjIPWC7/iv9EmiMYWC4ga+VsswDiG0Yq41eSrjUdiGY161kL++8I9I7Ut/22zQHE93VB8OgL0vbTIYib/jh9pNqD5yOOaBO/oLjLuCB0CgYEAlkkVZm22ERDLCXuV9CXxPdez4eqUlpyFBRMfCsZD/Xqy4NftW7i44nP+F1D2T0mbpfIaf2U3ziIAuksr6UbYnV5rfRj7wHu2UAfSk3Ezo/+Yujlylt4nzEXheoIa2Z4ifvT5/kxcEHlvkznw0LKtN44pfMucaGtaVecRsxSWDyk=",

    //异步通知地址
    'notify_url' => "http://tb.shengxuepai.cn/login/state_change",

    //同步跳转
    'return_url' => "http://tb.shengxuepai.cn/login/tz",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxRAPIGXdR5bxqAPz4ME5bTNwoM9lWm+5CA2h6rlPaB87yJ4caEJhnMRLayqkir/eQWPj9h1yUz8JLOLFBkXe2qLi+s22MpIgiv5VsqCaph/Sw733139m8dlY3FuuxJEVkW09DacREHUxhXCX2uZWnwx89ox3AzEbspC5Xc0P/0WZKs0i4GAngRYijZrCSHkLHCI6iZwRXl66Pu1Y11lGKrOcND3a+TVX+g2PpH7fsXF+bs/GBX8OGw1YC1egKvBH63jngf0RqKg7ZxlyyWltjqPIhMD9Wf/LuQvZVW5X3/3V9P0fHjBVA2RnaSmWG5ZCcZ3tPedJ9xCo06vC8pEOtwIDAQAB",
];