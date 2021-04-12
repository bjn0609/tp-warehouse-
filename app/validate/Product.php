<?php
declare (strict_types = 1);
namespace app\validate;
use think\Validate;

class Product extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'code'          =>  'require|max:10|number|unique:product',
        'name'          =>  'require|max:10|chsDash',
        'type'          =>  'require|max:10|chsDash',
        'unit'          =>  'require|max:5|chsDash',
        'price'          =>  'require|max:10|float',
        'sup'          =>  'require|max:10|chsDash'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'code.require'      => '编码不得为空~',
        'name.require'      => '名称不得为空~',
        'type.require'      => '规格不得为空~',
        'unit.require'      => '单位不得为空~',
        'price.require'      => '单价不得为空~',
        'sup.require'      => '供应商不得为空~',
        'code.max'          => '编码不得大于 10 位~',
        'name.max'          => '用户名不得大于 10 位~',
        'username.max'          => '名称不得大于 10 位~',
        'type.max'          => '规格不得大于 10 位~',
        'unit.max'          => '单位不得大于 5 位~',
        'price.max'          => '单价不得大于 10 位~',
        'sup.max'          => '供应商不得大于 10 位~',
        'code.number'      => '编码只能是数字~',
        'price.float'      => '编码只能含数字和小数点~',
        'code.unique'       => '编码已存在~',
        'name.chsDash'      => '产品名称不符合规范~',
        'sup.chsDash'      => '供应商名称不符合规范~',
        'type.chsDash'      => '规格名称不符合规范~',
        'unit.chsDash'      => '单位名称不符合规范~',
    ];
}
