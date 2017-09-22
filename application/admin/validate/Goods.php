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
        'status'=>'number|between:0,2',
        'market_price'=>'require|number',
        'sell_price'=>'number|require',
        'store'=>'require|number'
    ];

    protected $message=[
        'goods_name.require'=>'商品名称必须填写！',
        'goods_name.unique'=>'商品名称必须唯一！',
        'marketable.number'=>'是否上架参数出错！',
        'marketable.between'=>'是否上架参数超出范围',
        'status.number'=>'商品状态参数出错！',
        'status.between'=>'商品状态参数超出范围',
        'market_price.require'=>'市场价格必须填写',
        'market_price.number'=>'市场价格必须为数字',
        'sell_price.require'=>'销售价格必须填写',
        'sell_price.number'=>'销售价格必须为数字',
        'store.require'=>'库存量必须填写',
        'store.number'=>'库存量必须为数字',
    ];

    protected $scene=[
        'add'=>'goods_name,marketable,status,market_price,sell_price,store',
        'edit'=>'goods_name,marketable,status,market_price,sell_price,store'
    ];

}