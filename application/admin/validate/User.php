<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 17:00
 */
namespace app\admin\validate;

use think\Validate;

class User extends Validate{
    protected $rule = [
        //unique 用于验证当前请求的字段值 是否唯一 重点
        'phone'=>'require|unique:user',
    ];
    protected $message = [
        'username.require'=>'手机号必须填写',
        //unique 用于验证当前请求的字段值 是否唯一 重点
        'username.unique'=>'手机号必须唯一',
    ];


}