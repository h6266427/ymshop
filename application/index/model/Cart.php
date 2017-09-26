<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 11:51
 */
namespace app\index\model;

use think\Model;

class Cart extends Model{
    static public function cartById($uid){
        if(empty($uid)){
            return false;
        }
        $data=db('cart')->where($uid,'user_id')->select();
        return $data??false;

    }


}