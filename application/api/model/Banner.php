<?php

namespace app\api\model;

use think\Db;

class Banner
{
    public static function getBannerByID($id)
    {
        $result = Db::table('banner_item')->where('id', $id)->find();
        return $result;
    }
}
