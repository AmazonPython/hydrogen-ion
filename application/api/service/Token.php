<?php

namespace app\api\service;

class Token
{
    public static function generateToken()
    {
        // 32个字符组成随机字符串
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        return md5($randChar . $timestamp);
    }
}
