<?php

namespace app\lib\exception;

class CategoryException extends BaseException
{
    // HTTP 状态码
    public $code = 400;

    // 错误信息
    public $msg = '指定类目不存在，请检查参数';

    // 自定义的错误状态码
    public $errorCode = 50000;
}
