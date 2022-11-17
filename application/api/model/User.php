<?php

namespace app\api\model;

class User extends BaseModel
{
    public static function getByOpenID($openID)
    {
        $user = User::where('openid', $openID)->find();
        return $user;
    }
}
