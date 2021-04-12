<?php
namespace app\controller;

use app\model\Out as OutModel;
use app\validate\Product as ProValidate;
use think\exception\ValidateException;
use think\Request;
use app\BaseController;
use app\model\Product as ProModel;
use think\facade\View;

class  Product extends BaseController
{
    private $toast = 'public/toast';

    function test(){
        return view('test');
    }



    function index(){
        return View::fetch('index',
            ['list'  =>  ProModel::withSearch(['code', 'name', 'type', 'unit','price','sup','stock'],
                ['code'        =>  request()->param('code'),
                    'name'      =>  request()->param('name'),
                    'type'         =>  request()->param('type'),
                    'unit'   =>  request()->param('unit'),
                    'price'   =>  request()->param('price'),
                    'sup'   =>  request()->param('sup'),
                    'stock'   =>  request()->param('stock')])->order('code','asc')
                ->paginate([
                'list_rows'     =>  10,
                'query'         =>  request()->param()])
            ]);
}



//取出字符串中的整数
    function findNum($str=''){
        $str=trim($str);
        if(empty($str)){return '';}
        $temp=array('1','2','3','4','5','6','7','8','9','0');
        $result='';
        for($i=0;$i<strlen($str);$i++){
            if(in_array($str[$i],$temp)){
                $result.=$str[$i];
            }
        }
        return $result;
    }


    //添加产品
    public function create()
    {
        return view('create');
    }

    //保存产品
    public function save(Request $request)
    {
        $data = $request->param();

        //编码是否重复
        $codecheck = array_column($data,'code');
        $M = new ProModel();
        $c = $M->check($codecheck);
        if ($c && !empty($codecheck)){
            return  view($this->toast, [
                'infos'     =>  ['编码已经存在~'],
                'url_text'  =>  '返回上一页',
                'url_path'  =>  url('/product/create')
            ]);
        }


        try {
            validate(ProValidate::class)->batch(true)->check($data);
        } catch (ValidateException $exception) {
            return view($this->toast, [
                'infos' => $exception->getError(),
                'url_text' => '返回上一页',
                'url_path' => url('/product/create')
            ]);
        }
        //写入数据库
        $code = ProModel::create($data)->getData('code');

        //返回
        return $code ? view($this->toast, [
            'infos'     =>  ['操作成功~'],
            'url_text'  =>  '返回上一页',
            'url_path'  =>  url('/product/create')
        ]) : view($this->toast, [
            'infos'     =>  ['操作失败~'],
            'url_text'  =>  '返回上一页',
            'url_path'  =>  url('/product/create')
        ]) ;
    }




//删除
    public function delete($code)
    {
        $M = new ProModel();
        $stock = $M->where('code',$code)->field('stock')->select();
        $stock = $this->findNum($stock);
        if ($stock != 0){
            return view($this->toast, [
                'infos' => ['仍有库存,不能删除~'],
                'url_text' => '返回首页',
                'url_path' => url('/product')]);
        }else {
            return $del = $M->deletePro($code)
                ? view($this->toast, [
                    'infos' => ['删除成功~'],
                    'url_text' => '返回首页',
                    'url_path' => url('/product')
                ]) : view($this->toast, [
                    'infos' => ['操作失败~'],
                    'url_text' => '返回首页',
                    'url_path' => url('/product')]);
        }
    }


    //双击修改产品
    public function doubleClickChange(){
        $M = new ProModel();
        $code=isset($_POST["id"])?$_POST["id"]:0;
        $field=isset($_POST["name"])?$_POST["name"]:0;
        $data=isset($_POST["value"])?$_POST["value"]:0;
        //dump($_POST["id"]);
        $M->where('code',$code)->update([$field=>$data]);
        }
}



