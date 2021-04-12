<?php


namespace app\model;




use think\Model;

class Account extends Model
{
    //显示账表
    function getAcc()
    {
        $get = $this->select();
        return $get;
    }

    function product(){
        return $this->hasOne(Product::class,'code','code');
    }

}