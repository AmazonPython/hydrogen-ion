<?php

namespace app\api\model;

class Product extends BaseModel
{
    protected $hidden = [
        'delete_time',
        'main_img_id',
        'pivot',
        'from',
        'category_id',
        'create_time',
        'update_time'
    ];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImageUrl($value, $data);
    }

    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getMostRecent($count)
    {
        return Product::limit($count)->order('create_time','desc')->select();
    }

    public static function getProductsByCategoryID($categoryID)
    {
        return Product::where('category_id', $categoryID)->select();
    }

    public static function getProductDetail($id)
    {
        return Product::with(['imgs', 'properties'])->find($id);
    }
}
