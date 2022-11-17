<?php

namespace app\api\service;

use app\api\model\User;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code = '';
    protected $weChatID = '';
    protected $weChatSecret = '';
    protected $weChatLoginUrl = '';

    public function __construct($code)
    {
        $this->code = $code;
        $this->weChatID = config('weChat.app_id');
        $this->weChatSecret = config('weChat.app_secret');
        $this->weChatLoginUrl = sprintf(config('weChat.loginUrl'), $this->weChatID, $this->weChatSecret, $this->code);
    }

    public function get($code)
    {
        $result = curl_get($this->weChatLoginUrl);
        $result = json_decode($result, true);

        if (empty($result)) {
            throw new Exception('获取session_key和openID时异常，微信内部错误');
        } else {
            $loginFail = array_key_exists('errorCode', $result);

            if ($loginFail) {
                $this->processLoginError($result);
            } else {
                $this->grantToken($result);
            }
        }
    }

    private function processLoginError($result)
    {
        throw new WeChatException([
            'msg' => $result['errorMsg'],
            'errorCode' => $result['errorCode']
        ]);
    }

    private function grantToken($result)
    {
        $openId = $result['openID'];
        $user = UserModel::getByOpenID($openId);

        if ($user) {
            $uid = $user->id;
        } else {
            $uid = $this->newUser($openId);
        }

        $cacheHedValue = $this->prePareCacheValue($result, $uid);

        return $this->saveToCache($cacheHedValue);
    }

    private function newUser($openId)
    {
        $user = UserModel::create(['openid' => $openId]);

        return $user->id;
    }

    private function prePareCacheValue($result, $uid)
    {
        $cacheHedValue = $result;
        $cacheHedValue = $uid;
        $cacheHedValue['scope'] = 16;

        return $cacheHedValue;
    }

    private function saveToCache($cacheHedValue)
    {
        $key = self::generateToken();
        $value = json_encode($cacheHedValue);
        $expire_in = config('setting.token_expire_in');
        $request = cache($key, $value, $expire_in);

        if (!$request) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }

        return $key;
    }
}
