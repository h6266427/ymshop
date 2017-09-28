<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/24
 * Time: 21:20
 */
namespace app\index\controller;
use app\index\model\Signup as SignupModel;
use php\api_demo\SmsDemo;
use think\Controller;

class Signup extends Controller{
    public function index(){


        return $this->fetch('signup');
    }


    /*
     * 注册新用户
     *
     * */

    public function signUp(){
        $user=[
            'username'=>input('username'),
            'password'=>input('password')
        ];

        //验证
        $validate=validate('Signup');
        if(!$validate->scene('add')->check($user)){
            return $this->error($validate->getError());
        }

        //将密码加密
        $user['password']=md5($user['password']);

        $user['phone']=input('username');
        $user['reg_time']=time();

        $res=SignupModel::insertToUser($user);
        if($res!=false){
            return json([
                'msg'=>'注册成功！'
            ]);
        }else{
            return json(['msg'=>'注册失败...']);
        }
    }


    /*
     * 发送短信验证码
     *
     * */
    public function send(){

        $phoneNumber=input('phone');

        $demo = new SmsDemo(
            "LTAITu1egRxNy9iA",
            "v4QZE5HhPIn4UpC68WEJh8bu4z3zki"
        );
        $code=rand(100000,999999);
        return json(['sms'=>$code]);
        //echo "SmsDemo::sendSms\n";
        $response = $demo->sendSms(
            "一米", // 短信签名
            "SMS_99305017", // 短信模板编号
            $phoneNumber, // 短信接收者
            Array(  // 短信模板中字段的值
                "code"=>$code,
                "product"=>"一米"
            ),
            "123"
        );
        if($response){
            return json(['sms'=>$code]);
        }
        return false;
        //print_r($response);

        /*echo "SmsDemo::queryDetails\n";
        $response = $demo->queryDetails(
            "15640234002",  // phoneNumbers 电话号码
            "20170925", // sendDate 发送时间
            10, // pageSize 分页大小
            1 // currentPage 当前页码
        // "abcd" // bizId 短信发送流水号，选填
        );

        //print_r($response);*/

    }

}