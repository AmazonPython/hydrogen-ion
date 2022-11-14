<?php

namespace app\api\controller\v1;

use app\api\validate\IDCollection;

class Theme
{
    /**
     * @return string theme 模型
     * @url theme?ids=id1, id2...
     */
    public function getSimpleList($ids = '')
    {
        (new IDCollection())->goCheck();

        return 'ok';
    }
}
