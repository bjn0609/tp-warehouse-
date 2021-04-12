<?php


namespace app\model;


use think\Model;

class In extends Model
{
    //显示入库记录表
    function getInHistory()
    {
        $get = $this->select();
        return $get;
    }

    function product(){
        return $this->hasOne(Product::class,'code','code');
    }
}