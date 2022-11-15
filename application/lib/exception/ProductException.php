<?php

namespace app\lib\exception;

class ProductException extends BaseException
{
    // HTTP 状态码404
    public $code = 404;

    // 错误信息
    public $msg = '指定商品不存在，请检查商品ID';

    // 自定义的错误状态码
    public $errorCode = 20000;
}
