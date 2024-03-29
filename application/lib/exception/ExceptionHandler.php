<?php

namespace app\lib\exception;

use Exception;
use think\Env;
use think\exception\Handle;
use think\exception\HttpException;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    // 需要返回客户端请求的 URL 路径
    public function render(Exception $e)
    {
        if ($e instanceof BaseException) {
            // 如果是自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } elseif ($e instanceof HttpException && Env::get('app_debug') == false) {
            $this->code = 404;
            $this->errorCode = 999;
            $this->msg = '请求的地址不存在';
        } else {
            if (config('app_debug')){
                return parent::render($e);
            }

            $this->code = 500;
            $this->msg = '服务器内部错误';
            $this->errorCode = 999;
            $this->recordErrorLog($e);
        }

        $request = Request::instance();

        $result = [
            'errorCode' => $this->errorCode,
            'msg' => $this->msg,
            'request_url' => $request->url()
        ];

        return json($result, $this->code);
    }

    // 自定义日志写入级别，仅将异常写入日志
    private function recordErrorLog(Exception $e)
    {
        Log::init([
            'type' => 'File',
            'path' => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}
