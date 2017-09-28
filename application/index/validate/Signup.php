<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 18:10
 */
namespace app\index\validate;

use think\Validate;

class Signup extends Validate{

    protected $rule=[
        'username'=>['reg'=>'/^1[3|4|5|8][0-9]\d{4,8}$/'],
        'password'=>['reg'=>'/^[a-zA-Z]\w{5,19}$/']
    ];

    protected $message=[
        'username.reg'=>'用户名格式错误！',
        'password.reg'=>'密码格式错误！'
    ];

    protected $scene=[
        'add'=>'username,password'
    ];

}