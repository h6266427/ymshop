<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 15:43
 */
namespace app\index\model;

use think\Model;

class Address extends Model{


    //根据area_id查出地名
    static function areaById($area_id){
        if (empty($area_id)){
            return false;
        }
        $data=db('area')->find($area_id);
        return $data['area_name']??false;

    }


    /*
     * 添加到address表
     * */
    static function addAddress($data){
        if (empty($data)){
            return false;
        }
        //写入数据库
        $insert=db('address')->insert($data);
        return $insert??false;

    }

}