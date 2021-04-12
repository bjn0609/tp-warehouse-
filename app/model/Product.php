<?php


namespace app\model;

use think\Model;

class Product extends Model
{
    //显示产品表
    function getPro(){
        $get = $this->order('code','asc')->select();
        return $get;
    }


    //删除产品
    function deletePro($code){
        $where = [
            'code'  => $code
        ];
        $delete = $this->where($where)->delete();
        return $delete;
    }

    //检查编码是否重复
    function check($code){
        $where = [
            'code'  => $code
        ];
        $check = $this->where($where)->select();
        return $check;
    }


    //根据编码 获取 其他商品信息
    function getByCode($code,$field){
        $get = $this->where('code',$code)->field($field)->select();
        return $get;
    }

    //根据code查库存
    function searchStock($code){
        $s = $this->where("code",$code)->field("stock")->select();
        return $s;
    }

}