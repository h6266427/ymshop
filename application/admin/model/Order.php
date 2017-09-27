<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 14:03
 */
namespace app\admin\model;
use think\Model;

class Order extends Model{
    /*
     * 查出所有订单
     * */
    static public function allOrder(){
        $data = db('order')->order('create_time')->paginate(8);
        $page =  $data->render();
        //拿出所有数据，返回二/**/维数组
        $data = $data->all();
        return [
            'data'=>$data,
            'page'=>$page
        ];
    }
}