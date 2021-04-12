<?php


namespace app\model;


use think\Model;

class Out extends Model
{
    //显示出库记录表
    function getOutHistory()
    {
        $get = $this->select();
        return $get;
    }

    function product(){
        return $this->hasOne(Product::class,'code','code');
    }

}