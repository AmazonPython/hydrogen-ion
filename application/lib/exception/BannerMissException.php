<?php

namespace app\lib\exception;

class BannerMissException extends BaseException
{
    // HTTP 状态码404
    public $code = 404;

    // 错误信息
    public $msg = '请求参数不存在';

    // 自定义的错误状态码
    public $errorCode = 10001;
}
