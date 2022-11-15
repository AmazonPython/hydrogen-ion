<?php

namespace app\api\model;

class Theme extends BaseModel
{
    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('Product', 'theme_product', 'product_id', 'theme_id');
    }

    public static function getSimpleList($ids)
    {
        return Theme::with(['topicImg', 'headImg'])->select($ids);
    }

    public static function getThemeWithProducts($id)
    {
        return Theme::with(['products', 'topicImg', 'headImg'])->find($id);
    }
}
