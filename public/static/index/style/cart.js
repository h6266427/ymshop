function selectGoods(goods_id) {
    $goods_id=goods_id;
    $.ajax({
        type:'post',
        dataType:'json',
        data:{goods_id:$goods_id},
        url:'/index/Cart/select',
        success:function (json) {
            if(json.msg=='success'){
                $('#sum')[0].innerHTML="￥<b><?php echo $sum; ?></b>.00";
            }
        }
    })
}