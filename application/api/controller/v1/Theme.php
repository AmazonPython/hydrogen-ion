<?php

namespace app\api\controller\v1;

use app\api\model\Theme as ThemeModel;
use app\api\validate\IDCollection;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ProductException;

class Theme
{
    /**
     * @return string theme 模型
     * @url theme?ids=id1, id2...
     */
    public function getSimpleList($ids = '')
    {
        (new IDCollection())->goCheck();

        $ids = explode(',', $ids);
        $theme = ThemeModel::getSimpleList($ids);

        if ($theme->isEmpty()){
            throw new ProductException();
        }

        return $theme;
    }

    /**
     * @param $id
     * @url theme/id
     */
    public function getComplexOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $theme = ThemeModel::getThemeWithProducts($id);

        if (!$theme){
            throw new ProductException();
        }

        return $theme->hidden(['products.summary'])->toArray();
    }
}
