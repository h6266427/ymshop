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
        'username'=>"unique:user|['regex'=>'/^1[3|4|5|8][0-9]\d{4,8}$/']",
        'password'=>['regex'=>'/^[a-zA-Z]\w{5,19}$/']
    ];

    protected $message=[
        'username.regex'=>'用户名格式错误！',
        'username.unique'=>'用户名已存在！',
        'password.regex'=>'密码格式错误！'
    ];

    protected $scene=[
        'add'=>'username,password'
    ];

}