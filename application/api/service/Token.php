<?php

namespace app\api\service;

use app\lib\enum\ScopeEnum;
use app\lib\exception\ParameterException;
use app\lib\exception\TokenException;
use Exception;
use think\Cache;
use think\Request;

class Token
{
    public static function generateToken()
    {
        // 32个字符组成随机字符串
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        return md5($randChar . $timestamp);
    }

    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance() ->header('token');
        $vars = Cache::get($token);

        if (!$vars) {
            throw new TokenException();
        } else {
            if(!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            } else {
                throw new Exception('尝试获取的Token变量并不存在');
            }
        }
    }

    //当需要获取全局 UID 时，应当调用此方法，而非自己解析 UID
    public static function getCurrentUid()
    {
        $uid = self::getCurrentTokenVar('uid');
        $scope = self::getCurrentTokenVar('scope');

        if ($scope == ScopeEnum::SuperUser) {
            // 只有 Super 权限才可以自己传入 uid，且必须在 get 参数中，post 不接受任何 uid 字段
            $userID = input('get.uid');

            if (!$userID) {
                throw new ParameterException([
                    'msg' => '没有指定需要操作的用户对象'
                ]);
            }

            return $userID;

        } else {
            return $uid;
        }
    }
}
