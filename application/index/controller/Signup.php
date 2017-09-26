<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/24
 * Time: 21:20
 */
namespace app\index\controller;
use php\api_demo\SmsDemo;
use think\Controller;

class Signup extends Controller{
    public function index(){


        return $this->fetch('signup');
    }

    public function signUp(){


    }


    public function send(){

        $phoneNumber=input('phone');

        $demo = new SmsDemo(
            "LTAITu1egRxNy9iA",
            "v4QZE5HhPIn4UpC68WEJh8bu4z3zki"
        );
        $code=rand(100000,999999);

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