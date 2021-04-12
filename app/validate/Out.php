<?php
declare (strict_types = 1);
namespace app\validate;
use think\Validate;

class Out extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [

        'outnum'          =>  'require|max:10|integer',
        'outman'          =>  'require|max:10|chsDash',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'outnum.require'      => '数量不得为空~',
        'outman.require'      => '操作人不得为空~',
        'outnum.max'          => '数量不得大于 10 位~',
        'outman.max'          => '操作人不得大于 10 位~',
        'outnum.integer'      => '数量只能是正负整数~',
        'outman.chsDash'      => '操作人名称不符合规范~',
    ];


}
