<?php
namespace app\admin\validate;
use think\Validate;
class Manager extends Validate{

    protected $rule=[
        'manager_name'=>'require|unique:manager'
    ];

    protected $message=[
        'manager_name.require'=>'管理者名称必须填写',
        'manager_name.unique'=>'管理者名称已存在'
    ];

    protected $scene=[
        'add'=>'manager_name',
        'edit'=>'manager_name'
    ];

}