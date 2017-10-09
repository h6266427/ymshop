<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/9
 * Time: 11:46
 */
namespace app\index\model;
use think\Model;

class Personal extends Model{

    static public function orderByUserId($userId){
        if (empty($userId)){
            return false;
        }
        $orderData=db('order')->where('user_id',$userId)->select();
        if (!empty($orderData)){
            return $orderData;
        }
        return false;


    }




}