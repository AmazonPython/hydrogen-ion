<?php

namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{
    // HTTP 状态码404, 200
    public $code = 400;

    // 错误信息
    public $msg = '参数错误';

    // 自定义的错误状态码
    public $errorCode = 10000;
}
