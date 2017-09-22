<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 20:40
 */
namespace app\admin\validate;
use think\Validate;
class Goods extends Validate{

    protected $rule=[
        'goods_name'=>'require|unique:goods',
        'marketable'=>'number|between:0,1',
        'status'=>'number|between:0,2'
    ];

    protected $message=[
        'goods_name.require'=>'商品名称必须填写！',
        'goods_name.unique'=>'商品名称必须唯一！',
        'marketable.number'=>'是否上架参数出错！',
        'marketable.between'=>'是否上架参数超出范围',
        'status.number'=>'商品状态参数出错！',
        'status.between'=>'商品状态参数超出范围'
    ];

    protected $scene=[
        'add'=>'goods_name,marketable,status',
        'edit'=>'goods_name,marketable,status'
    ];

}