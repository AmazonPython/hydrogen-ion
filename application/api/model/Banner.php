<?php

namespace app\api\model;

class Banner extends BaseModel
{
    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerByID($id)
    {
        return Banner::with(['items', 'items.img'])->find($id);
    }
}
