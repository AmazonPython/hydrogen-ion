<?php

namespace app\lib\exception;

use Exception;
use think\exception\Handle;

class ExceptionHandler extends Handle
{
    public function render(Exception $exception)
    {
        return json($exception);
    }
}
