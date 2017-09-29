<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/24
 * Time: 21:54
 */
namespace app\index\model;

use think\Model;

class Signup extends Model{
    static public function insertToUser($data){
        if(empty($data)){
            return false;
        }
        $res=db('user')->insert($data);
        return $res??false;

    }



}