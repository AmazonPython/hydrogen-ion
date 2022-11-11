<?php

namespace app\lib\exception;

class ParameterException extends BaseException
{
    // HTTP 状态码
    public $code = 400;

    // 错误信息
    public $msg = '通用参数错误';

    // 自定义的错误状态码
    public $errorCode = 10000;
}
