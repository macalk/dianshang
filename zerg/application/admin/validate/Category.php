<?php
namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'name' => 'require|max:10',
        'parent_id' => 'number',
        'id' => 'number',
        'status' => 'number|in:-1,0,1',
        'listorder' => 'number'
    ];

    protected $message = [
        'name.require' => '名字不能为空',
        'name.mas' => '名字长度不能超过10个单位',
        'status.in' => '状态范围在-1，0，1，之间'
    ];

    //场景设置
    protected $scene = [
        'add'  =>  ['name','parent_id','id'],//添加
        'listorder' => ['id','listorder']//排序
    ];
}