<?php

namespace app\api\controller\v1;

use app\api\validate\IDMustBePositiveInt;
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
        (new IDMustBePositiveInt())->goCheck();

        /*$data = [
            'id' => $id
        ];

        $validate = new Validate([
            'name' => 'require|max:10',
            'email' => 'email'
        ]);

        $validate = new IDMustBePositiveInt();

        $result = $validate->batch()->check($data);

        if ($result){

        }else{

        };*/

    }
}
