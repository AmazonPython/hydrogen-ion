<?php

namespace App\Api\Controller\v1;

use app\api\validate\TestValidate;
use think\Validate;

class Banner
{
    /**
     * 获取指定 id 的 banner 信息
     * @url /banner/:id
     * @http get
     * @id banner 的 id 值
     */
    public function getBanner($id)
    {
        $data = [
            'name' => 'test',
            'email' => '1@test.com'
        ];

        /*$validate = new Validate([
            'name' => 'require|max:10',
            'email' => 'email'
        ]);*/

        $validate = new TestValidate();

        $result = $validate->batch()->check($data);
        var_dump($result);
    }
}
