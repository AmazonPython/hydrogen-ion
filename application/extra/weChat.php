<?php

use think\Env;

return [
    /**
     * 微信小程序配置
     */

    // 小程序 app_id
    'app_id' => Env::get('app_id'),
    // 小程序 app_secret
    'app_secret' => Env::get('app_secret'),

    // 微信使用 code 获取用户openid 及 session_key 的 url 地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
];
