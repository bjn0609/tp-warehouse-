<?php
declare (strict_types = 1);
namespace app\validate;
use think\Validate;

class In extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'innum'          =>  'require|max:10|integer',
        'inman'          =>  'require|max:10|chsDash',
        'incode'          =>  'require|max:10|number|unique:in',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'innum.require'      => '数量不得为空~',
        'inman.require'      => '操作人不得为空~',
        'incode.require'      => '批号不得为空~',
        'innum.max'          => '数量不得大于 10 位~',
        'inman.max'          => '操作人不得大于 10 位~',
        'incode.max'          => '批号不得大于 10 位~',
        'innum.integer'      => '数量只能是正负整数~',
        'incode.number'      => '批号只能是数字~',
        'inman.chsDash'      => '操作人名称不符合规范~',
        'incode.unique'       => '入库编号已存在~',
    ];


}
