<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 15:37
 */
namespace app\index\model;
use think\Model;
use think\Db;

class Check extends Model{

    static public function checkCartList($userId){
        if(empty($userId)){
            return false;
        }
        //三表联查
        $data=db('cart')
            ->alias('c')
            ->field('c.cart_id,c.user_id,c.goods_id,c.goods_num,c.selected,
            g.goods_name,g.keywords,g.sell_price,
            i.image_s_url')
            ->join('goods g','g.goods_id=c.goods_id','left')
            ->join('images i','i.goods_id=c.goods_id','left')
            ->where(['c.user_id'=>$userId,'i.is_face'=>1,'c.selected'=>1])
            ->select();
        if(!empty($data)){
            return $data;
        }
        return false;

    }


    /*
     * 提交订单
     *
     * */
    static function createOrder($userId,$addrData){
        if(empty($userId||$addrData)){
            return false;
        }

        //根据user_id在购物车表里查询selected=1的商品id和数量
        $goods=db('cart')->alias('c')
            ->field('c.goods_id,c.goods_num')
            ->where('user_id',$userId)
            ->where('selected',1)
            ->select();
        //遍历商品信息添加sell_price字段
        foreach ($goods as $k=>$v){
            $goods[$k]['sell_price']=db('goods')
                ->field('sell_price')
                ->where('goods_id',$goods[$k]['goods_id'])
                ->find()['sell_price'];
        }

        //获取总价；
        $amount=0;
        foreach ($goods as $k =>$v){
            $amount+=$goods[$k]['goods_num']*$goods[$k]['sell_price'];
        }

        //填写订单字段
        $order=[
            //'order_id'=>date('Ymd',time()).'0'.rand(100000,200000),
            'total_amount'=>$amount,
            'user_id'=>$userId,
            'status'=>'normal',
            'create_time'=>time(),
            'last_modify'=>time(),
            'ship_area'=>$addrData['area'],
            'ship_addr'=>$addrData['address'],
            'ship_name'=>$addrData['ship_name'],
            'ship_mobile'=>$addrData['ship_mobile']
        ];


        //处理订单号
        //查看订单表最后一条是不是当天的订单号，如果没有则创建一个当天的订单号，有的话则不作处理，让其自增
        $lastOrederId=db('order')->field('order_id')->order('order_id desc')->limit(0,1)->find();
        if(substr($lastOrederId['order_id'],0,8)!=date('Ymd',time())){
            $order['order_id']=date('Ymd',time()).'0'.rand(100000,200000);
        }

        //手动控制事务
        Db::startTrans();
        try{
            //将订单信息写入order表并返回order_id
            $orderId=db('order')->insertGetId($order);


            foreach ($goods as $k=>$v){
                //遍历商品信息添加order_id
                $goods[$k]['order_id']=$orderId;
                //将商品信息写入订单详情表
                db('orderdetail')->insert($goods[$k]);
                //将商品信息从购物车表删除
                db('cart')->delete($goods[$k]);

                //将商品表里的冻结库存加上结算的数量；
                $frzNum=\db('goods')->field('freez')->where('goods_id',$goods[$k]['goods_id'])->find()['freez']+$goods[$k]['goods_num'];
                //更新商品表
                db('goods')->where('goods_id',$goods[$k]['goods_id'])->update(['freez'=>$frzNum]);
            }

            //Db::table('think_user')->find(1);
            //Db::table('think_user')->delete(1);
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
        return ['msg'=>'订单提交成功！'];

    }



    static public function allSheng(){
        $data = db('area')->where(array('parent_id'=>1))->select();
        return $data;
    }
    static public function sheng(){

    }


    //已登录状态下根据user_id查出该用户的地址信息
    static public function userAddress($userId){
        if (empty($userId)){
            return false;
        }

        $addrData=db('address')->where('user_id',$userId)->select();
        if (!empty($addrData)){
            return $addrData;
        }
        return false;

    }

    //根据addr_id查出该条地址信息
    static public function queryAddr($addrId){
        if (empty($addrId)){
            return false;
        }

        $addrData=db('address')->find($addrId);
        if (!empty($addrData)){
            return $addrData;
        }
        return false;

    }
}