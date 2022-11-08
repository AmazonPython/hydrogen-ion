<?php

namespace app\api\validate;

use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        // 获取传入参数并校验
        $request = Request::instance();
        $params = $request->param();

        $result = $this->check($params);

        if (! $result){
            $error = $this->error;
            throw new Exception($error);
        }else{
            return true;
        }
    }
}
