<?php

namespace app\lib\exception;

class ThemeException extends BaseException
{
    // HTTP 状态码404
    public $code = 404;

    // 错误信息
    public $msg = '指定主题不存在，请检查主题ID';

    // 自定义的错误状态码
    public $errorCode = 30000;
}
