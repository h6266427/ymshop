<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 15:32
 */
namespace app\index\controller;

use think\Controller;
use app\index\model\Address as AddressModel;
class Address extends Controller{

    public function add(){
        $data=[
            'user_id'=>session('user')['user_id'],
            'address'=>input('address'),
            'ship_name'=>input('ship_name'),
            'ship_mobile'=>input('ship_mobile'),
            'create_time'=>time()
        ];

        //判断是否勾选默认地址
        if(input('def_addr')=='on'){
            $data['def_addr']=1;
        }else{
            $data['def_addr']=0;
        }

        $province=AddressModel::areaById(input('area_sheng'));
        $city=AddressModel::areaById(input('area_shi'));
        $area=AddressModel::areaById(input('area_qu'));
        $data['area']=$province.$city.$area;
        //dump($data);
        $insert=AddressModel::addAddress($data);
        if(!$insert){
            return $this->error('地址保存失败..');
        }

        return '<script>alert(\'地址保存成功！\');window.location.href="/index/Check/index";</script>';
    }


}