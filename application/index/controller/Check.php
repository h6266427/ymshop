<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 10:40
 */
namespace app\index\controller;

use app\index\model\Check as CheckModel;
use think\Controller;

class Check extends Controller{
    public function index(){
        //查出所有数据
        $data = CheckModel::allSheng();
        //把数据分配到模板
        $this->assign('data',$data);
        return $this->fetch('check');
    }
    public function sheng($sheng){

        $city = db('area')->where(array('parent_id'=>$sheng))->select();
        return json(
            $city
        );

    }
    public function shi($shi){

        $xian = db('area')->where(array('parent_id'=>$shi))->select();
        return json(
            $xian
        );

    }


}