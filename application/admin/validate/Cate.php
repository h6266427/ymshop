<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 20:40
 */
namespace app\admin\validate;
use think\Validate;
class Cate extends Validate{

    protected $rule=[
        'cate_name'=>'require|unique:cate'
    ];

    protected $message=[
        'cate_name.require'=>'分类名称必须填写！',
        'cate_name.unique'=>'分类名称必须唯一！'
    ];

    protected $scene=[
        'add'=>'cate_name',
        'edit'=>'cate_name'
    ];

}