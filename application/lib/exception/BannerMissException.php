<?php

namespace app\lib\exception;

class BannerMissException extends BaseException
{
// HTTP 状态码404, 200
    public $code = 404;

    // 错误信息
    public $msg = '参数错误';

    // 自定义的错误状态码
    public $errorCode = 40000;
}
