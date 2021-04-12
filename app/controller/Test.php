<?php


namespace app\controller;
use app\model\In as InModel;
use app\model\Product;
use app\model\In;
use app\model\Product as ProModel;
use think\facade\Db;
use app\model\Account as AccModel;

class Test
{
    function findNum($str = '')
    {
        $str = trim($str);
        if (empty($str)) {
            return '';
        }
        $temp = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
        $result = '';
        for ($i = 0; $i < strlen($str); $i++) {
            if (in_array($str[$i], $temp)) {
                $result .= $str[$i];
            }
        }
        return $result;
    }



    //批量添加数据
    function add()
    {
        for ($i = 300001;$i<=310000;$i++){
        //数据插入入库记录表
        $I = new InModel();
        $S = new AccModel;
        $result = $I->create([
            'code' => '1001',
            'price' => '5',
            'validity' => '2022-12-31 00:00:00',
            'innum' => '200',
            'inman' => '管理员',
            'intime' => date("Y-m-d H:i:s",strtotime("+$i second")),
            'incode' => $i,
        ]);


        //新建数据到账表
        $result1 = $S->create([
            'code' => '1001',
            'price' => '5',
            'validity' => '2022-12-31 00:00:00',
            'num' => '200',
            'man' => '管理员',
            'time' => date("Y-m-d H:i:s",strtotime("+$i second")),
            'incode' => $i,
            'iotype' => '入库',
            'iocode' => '1',
            'remains' => '200',
        ]);
        }
}

    function addPro()
    {
        for ($i = 11001;$i<=20000;$i++){
            //数据插入入库记录表
            $M = new ProModel();
            $result = $M->create([
                'code' => $i,
                'name' => $i,
                'type' => 'test2',
                'unit' => '个',
                'price' => '2',
                'sup' => '测试供应商2',
                'stock' => 0,
            ]);
        }
    }

//批量删
    function delete(){
        $I = new InModel();
        $S = new AccModel;
        $I->where('code','101')->delete();
        $S->where('code','101')->delete();
    }

    function gl(){
        $acc = AccModel::find(1);
        return $acc->product->type;
    }

}
