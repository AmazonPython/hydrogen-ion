<?php

namespace app\api\model;

class Image extends BaseModel
{
    protected $hidden = ['id', 'from', 'delete_time'];

    public function getUrlAttr($value, $data)
    {
        return $this->prefixImageUrl($value, $data);
    }
}
