<?php

namespace app\lib\exception;

class SuccessMessage extends BaseException
{
    // 201 创建成功，202需要一个异步的处理才能完成请求
    public $code = 201;
    public $msg = 'ok';
    public $errorCode = 0;
}
