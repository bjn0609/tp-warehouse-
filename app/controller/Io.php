<?php


namespace app\controller;
use app\validate\In as InValidate;
use app\validate\Out as OutValidate;
use think\Exception;
use think\exception\ValidateException;
use think\Request;
use app\model\Product as ProModel;
use app\model\In as InModel;
use app\model\Out as OutModel;
use app\model\Account as AccModel;
use think\facade\Db;

class Io extends Product
{
    private $toast = 'public/toast';
    //显示入库记录

    public function inHistory(){
        return view('inHistory');
    }
    function list1(){
        $page = $_GET["page"];
        $limit = $_GET["limit"];
        $I = new InModel();
        $data = $I->where('code','>',0)->page($page,$limit)->order('intime','desc')->select();

        //把关联后的产品信息插入接口数据
        $dataarr = $data->toArray();
        $code0 =array_column($dataarr,'code');
        foreach ($code0 as $code){
            $list = InModel::with('product')->where('code',$code)->field('code')->distinct(true)->force('code')->cache(true)->select();
        }
        foreach($list as $i){
            $name = $i->product->name;
            $type = $i->product->type;
            $unit = $i->product->unit;
            $sup = $i->product->sup;
        }
        $nameArr = [
            'name'=>$name
        ];
        $typeArr = [
            'type'=>$type
        ];
        $unitArr = [
            'unit'=>$unit
        ];
        $supArr = [
            'sup'=>$sup
        ];
        array_walk($dataarr,function (&$value, $key, $nameArr){
            $value = array_merge($value, $nameArr);
        },$nameArr);
        array_walk($dataarr,function (&$value, $key, $typeArr){
            $value = array_merge($value, $typeArr);
        },$typeArr);
        array_walk($dataarr,function (&$value, $key, $unitArr){
            $value = array_merge($value, $unitArr);
        },$unitArr);
        array_walk($dataarr,function (&$value, $key, $supArr){
            $value = array_merge($value, $supArr);
        },$supArr);
        $data = (Object)$dataarr;

        $count = $I->where('code','>',0)->count();
        $arr = array();
        $arr['code'] = 0;
        $arr['msg'] = "";
        $arr['count'] = $count;
        $arr['data'] = $data;
        return $arr;
    }

    //显示出库记录
    public function outHistory(){
        return view('outHistory');
    }

    function list2(){
        $O = new OutModel();
        $page = $_GET["page"];
        $limit = $_GET["limit"];
        $data = $O->page($page,$limit)->order('outtime','desc')->select();
        //把关联后的产品信息插入接口数据
        $dataarr = $data->toArray();
        $code0 =array_column($dataarr,'code');
        foreach ($code0 as $code){
            $list = OutModel::with('product')->where('code',$code)->field('code')->distinct(true)->force('code')->cache(true)->select();
        }
        foreach($list as $o){
            $name = $o->product->name;
            $type = $o->product->type;
            $unit = $o->product->unit;
            $price = $o->product->price;
            $sup = $o->product->sup;
        }
        $nameArr = [
            'name'=>$name
        ];
        $typeArr = [
            'type'=>$type
        ];
        $unitArr = [
            'unit'=>$unit
        ];
        $priceArr = [
            'price'=>$price
        ];
        $supArr = [
            'sup'=>$sup
        ];
        array_walk($dataarr,function (&$value, $key, $nameArr){
            $value = array_merge($value, $nameArr);
        },$nameArr);
        array_walk($dataarr,function (&$value, $key, $typeArr){
            $value = array_merge($value, $typeArr);
        },$typeArr);
        array_walk($dataarr,function (&$value, $key, $unitArr){
            $value = array_merge($value, $unitArr);
        },$unitArr);
        array_walk($dataarr,function (&$value, $key, $priceArr){
            $value = array_merge($value, $priceArr);
        },$priceArr);
        array_walk($dataarr,function (&$value, $key, $supArr){
            $value = array_merge($value, $supArr);
        },$supArr);
        $data = (Object)$dataarr;

        $count = $O->where('code','>',0)->count();
        $arr = array();
        $arr['code'] = 0;
        $arr['msg'] = "";
        $arr['count'] = $count;
        $arr['data'] = $data;
        return $arr;
    }

    //出库记录详情
    public function detail(){
    return view('detail');
}

    function list4()
    {
        (input('id'));
        $url =  'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $mid = strstr($url,'outtime');
        $time = substr($mid,14,21);
        $time1 = trim($time);
        $time2 = str_replace('%20',' ',$time1);
        $S = new AccModel();
        $data = $S->where('time',$time2)->order('time','desc')->force('code')->cache(true)->select();
        dump($time);
        dump($data);
        //把关联后的产品信息插入接口数据
        $dataarr = $data->toArray();
        $code0 =array_column($dataarr,'code');
        foreach ($code0 as $code){
            $list = AccModel::with('product')->where('code',$code)->field('code')->distinct(true)->force('code')->cache(true)->select();
        }

        foreach($list as $acc){
            $name = $acc->product->name;
            $type = $acc->product->type;
            $unit = $acc->product->unit;
            $price = $acc->product->price;
            $sup = $acc->product->sup;
        }
        $nameArr = [
            'name'=>$name
        ];
        $typeArr = [
            'type'=>$type
        ];
        $unitArr = [
            'unit'=>$unit
        ];
        $priceArr = [
            'price'=>$price
        ];
        $supArr = [
            'sup'=>$sup
        ];
        array_walk($dataarr,function (&$value, $key, $nameArr){
            $value = array_merge($value, $nameArr);
        },$nameArr);
        array_walk($dataarr,function (&$value, $key, $typeArr){
            $value = array_merge($value, $typeArr);
        },$typeArr);
        array_walk($dataarr,function (&$value, $key, $unitArr){
            $value = array_merge($value, $unitArr);
        },$unitArr);
        array_walk($dataarr,function (&$value, $key, $priceArr){
            $value = array_merge($value, $priceArr);
        },$priceArr);
        array_walk($dataarr,function (&$value, $key, $supArr){
            $value = array_merge($value, $supArr);
        },$supArr);
        $data = (Object)$dataarr;

        $count = $S->where('code','>',0)->count();
        $arr = array();
        $arr['code'] = 0;
        $arr['msg'] = "";
        $arr['count'] = $count;
        $arr['data'] = $data;
        return $arr;
    }



    //显示账表
    public function account(){
        $S = new AccModel();
        $I = new InModel();

        //插入有效期
        do{
            $incode = $S->where('validity',null)->field('incode')->limit(1)->select()->toArray();
            $incode0 = array_column($incode, 'incode');
            $incode1 = implode($incode0);
            $vali = $I->where('incode', $incode1)->field('validity')->select()->toArray();
            $vali0 = array_column($vali, 'validity');
            $vali1 = implode($vali0);
            $list = ['incode' => $incode1, 'validity' => $vali1];
            $S->where('incode', $incode1)->save($list);
        }while (!empty($incode1));
        return view('account');
    }
    function list3(){
        $page = $_GET["page"];
        $limit = $_GET["limit"];
        $S = new AccModel();
        $data = $S->where('code','>',0)->page($page,$limit)->order('time','desc')->force('code')->cache(true)->select();

        //把关联后的产品信息插入接口数据
        $dataarr = $data->toArray();
        $code0 =array_column($dataarr,'code');
        foreach ($code0 as $code){
        $list = AccModel::with('product')->where('code',$code)->field('code')->distinct(true)->force('code')->cache(true)->select();
        }

        foreach($list as $acc){
            $name = $acc->product->name;
            $type = $acc->product->type;
            $unit = $acc->product->unit;
            $price = $acc->product->price;
            $sup = $acc->product->sup;
        }
        $nameArr = [
            'name'=>$name
        ];
        $typeArr = [
            'type'=>$type
        ];
        $unitArr = [
            'unit'=>$unit
        ];
        $priceArr = [
            'price'=>$price
        ];
        $supArr = [
            'sup'=>$sup
        ];
        array_walk($dataarr,function (&$value, $key, $nameArr){
            $value = array_merge($value, $nameArr);
        },$nameArr);
        array_walk($dataarr,function (&$value, $key, $typeArr){
            $value = array_merge($value, $typeArr);
        },$typeArr);
        array_walk($dataarr,function (&$value, $key, $unitArr){
            $value = array_merge($value, $unitArr);
        },$unitArr);
        array_walk($dataarr,function (&$value, $key, $priceArr){
            $value = array_merge($value, $priceArr);
        },$priceArr);
        array_walk($dataarr,function (&$value, $key, $supArr){
            $value = array_merge($value, $supArr);
        },$supArr);
        $data = (Object)$dataarr;

        $count = $S->where('code','>',0)->count();
        $arr = array();
        $arr['code'] = 0;
        $arr['msg'] = "";
        $arr['count'] = $count;
        $arr['data'] = $data;
        return $arr;
    }


    //取出字符串中的整数
    function findNum($str=''){
        $str=trim($str);
        if(empty($str)){return '';}
        $temp=array('1','2','3','4','5','6','7','8','9','0','-');
        $result='';
        for($i=0;$i<strlen($str);$i++){
            if(in_array($str[$i],$temp)){
                $result.=$str[$i];
            }
        }
        return $result;
    }


    //从账表中计算某个入库批号的剩余库存
    function sumIncodeStock($incode){
        $a = Db::query("select num*iocode AS sum from crk_account WHERE incode=$incode");
        $b = array_column($a,'sum');
        return array_sum($b);
    }

    //从账表中计算某个产品的剩余库存
    function sumStock($code){
        $a = Db::query("select num*iocode AS sum from crk_account WHERE code=$code");
        $b = array_column($a,'sum');
        return array_sum($b);
    }



    //入库界面
    public function in(){
        return view('in');
    }


    //保存入库
    public function savein(Request $request)
    {
        $data = $request->param();
        $M = new ProModel();
        $I = new InModel();
        $S = new AccModel();
        try {
            validate(InValidate::class)->batch(true)->check($data);
        } catch (ValidateException $exception) {
            return view($this->toast, [
                'infos' => $exception->getError(),
                'url_text' => '返回上一页',
                'url_path' => url('/io/in')
            ]);
        }
        //数据插入入库记录表
        $result = $I->create([
            'code' => $_POST["code"],
            'price' =>$_POST["price"],
            'validity' =>$_POST["validity"],
            'innum' =>$_POST["innum"],
            'inman' =>$_POST["inman"],
            'intime'=> date("Y-m-d H:i:s"),
            'incode' =>$_POST["incode"],
        ]);


        //新建数据到账表
        $result1 = $S->create([
            'code' => $_POST["code"],
            'price' =>$_POST["price"],
            'validity' =>$_POST["validity"],
            'num' =>$_POST["innum"],
            'man' =>$_POST["inman"],
            'time'=> date("Y-m-d H:i:s"),
            'incode' =>$_POST["incode"],
            'iotype' =>'入库',
            'iocode' =>'1',
            'remains'=>$_POST["innum"]
        ]);

        //更新首页产品表的库存
        $stockAll = $this->sumStock($_POST["code"]);
        $data=isset($stockAll)?$stockAll:0;
        $result2 = $M->where('code',$_POST["code"])->update(['stock'=>$data]);

        return $result && $result1 && $result2 ? view($this->toast, [
            'infos'     =>  ['操作成功~'],
            'url_text'  =>  '返回上一页',
            'url_path'  =>  url('/io/in')
        ]) : view($this->toast, [
            'infos'     =>  ['操作失败~'],
            'url_text'  =>  '返回上一页',
            'url_path'  =>  url('/io/in')
        ]);
    }



    //出库界面
    public function out(){
        return view('out');
    }


    public function saveOut(Request $request)
    {
        $M = new ProModel();
        $O = new OutModel();
        $S = new AccModel();

        $data = $request->param();
        $code = $_POST["code"];
        try {
            validate(OutValidate::class)->batch(true)->check($data);
        } catch (ValidateException $exception) {
            return view($this->toast, [
                'infos' => $exception->getError(),
                'url_text' => '返回上一页',
                'url_path' => url('/io/out')
            ]);
        }


        //出库量不得大于库存
        $stockAll = $this->sumStock($_POST["code"]);
        if ($_POST["outnum"] > $stockAll){
            return view($this->toast, [
                'infos'     =>  ['出库量不得大于库存~'],
                'url_text'  =>  '返回上一页',
                'url_path'  =>  url('/io/out')
            ]);
        }


        //数据插入出库记录表
        $result = $O->create([
            'code' => $_POST["code"],
            'outnum' =>$_POST["outnum"],
            'outman' =>$_POST["outman"],
            'outtime'=> date("Y-m-d H:i:s"),
        ]);



        //插入编辑账表
        //修改入库的remains
        $code = $_POST["code"];

        //查编码对应的剩余库存
        $stock = $S->where('code',$code)->where('remains','>',0)->field('remains')->order('time','asc')->select()->toArray();
        //$stockInfo = $S->where('code',$code)->where('remains','>',0)->order('time','asc')->select()->toArray();
        $i = 0;
        $out = 0;
        $need = $_POST["outnum"];   //需要出库的值
        do{
            $out = $out + implode($stock[$i]);
            $i++;
        }while ($out<$need);
        $toomuch =  $out - $need;  //多出库的值  也就是所用到的最后一个库存的剩余量
        //查找时间第i小的  也就是需要改remains的 时间比它小的remains改为0
        $time = $S->where('code',$code)->where('remains','>',0)->order('time','asc')->field('time')->select()->toArray();
        //修改remains
        $lasttime = implode($time[$i-1]);
        $lastremains = $S->where('code',$code)->where('remains','>',0)->where('time',$lasttime)->field('remains')->select();
        $lastremains1 = $this->findNum($lastremains);
        $lastOut = $lastremains1 - $toomuch; //最后一批的出库数  其他前面的出库数就是remains
        //插入出库到账表    前面的循环找入库的数据 对应就是出库数据   最后个出的量就是
        $lastIncode = $S->where('code', $code)->where('remains', '>', 0)->order('time', 'asc')->field('incode')->limit($i-1, 1)->select()->toArray();
        $lastIncode0 = array_column($lastIncode, 'incode');
        $lastIncode1 = implode($lastIncode0);
        //查按时间第j个的num和incode
        for ($j = 0;$j<$i-1;$j++) {
            $data = $S->where('code', $code)->where('remains', '>', 0)->order('time', 'asc')->field('remains,incode')->limit($j, 1)->select()->toArray();
            $remains = array_column($data, 'remains');
            $incode0 = array_column($data, 'incode');
            $num = implode($remains);
            $incode = implode($incode0);
            $S->create([
                'code' => $_POST["code"],
                'num' => $num,
                'man' => $_POST["outman"],
                'time' => date("Y-m-d H:i:s"),
                'incode' => $incode,
                'iotype' => '出库',
                'iocode' => '-1'
            ]);
        }

        $S->create([
            'code' => $_POST["code"],
            'num' => $lastOut,
            'man' => $_POST["outman"],
            'time' => date("Y-m-d H:i:s"),
            'incode' => $lastIncode1,
            'iotype' => '出库',
            'iocode' => '-1'
        ]);

        $update1 = $S->where('code',$code)->where('remains','>',0)->where('time',$lasttime)->update(['remains'=>$toomuch]);
        $update2 = $S->where('code',$code)->where('remains','>',0)->where('time','<',$lasttime)->update(['remains'=>0]);
        $result1 = $S->where('code',$code)->where('iocode',1)->where('time','<=',$lasttime)->select();


        //更新首页产品表的库存
        //产品总库存
        $stockAll1 = $this->sumStock($_POST["code"]);
        $data=isset($stockAll1)?$stockAll1:0;
        $result2 = $M->where('code',$_POST["code"])->update(['stock'=>$data]);

        //dump($result);dump($result1);dump($result2);

        return $result && $result1 && $result2 ? view($this->toast, [
            'infos'     =>  ['操作成功~'],
            'url_text'  =>  '返回上一页',
            'url_path'  =>  url('/io/out')
        ]) : view($this->toast, [
            'infos'     =>  ['操作失败~'],
            'url_text'  =>  '返回上一页',
            'url_path'  =>  url('/io/out')
        ]);
    }
}