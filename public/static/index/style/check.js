

$("#sheng").change(function () {
    var sheng=$('#sheng').val();
    console.log(sheng);
    $.ajax({
        type:'GET',
        dataType:'json',
        data:{sheng:sheng},
        url:"/index.php/index/Check/sheng",
        success:function (d) {
            $("#shi").empty();
            console.log(d);
            $("#shi").append("<option value=''>请选择</option>");
            for (var i = 0; i < d.length; i++) {
                $("#shi").append("<option value="+d[i].area_id+">"+d[i].area_name+"</option>")
            }
        }
    })
});


$("#shi").change(function () {
    var shi = $('#shi').val();
    console.log(shi);
    $.ajax({
        type: 'GET',
        dataType: 'json',
        data: {shi: shi},
        url: "/index.php/index/Check/shi",
        success: function (d) {
            $("#xian").empty();
            //    console.log(d);
            $("#xian").append("<option value=''>请选择</option>");
            for (var i = 0; i < d.length; i++) {
                $("#xian").append("<option value="+d[i].area_id+">"+d[i].area_name+"</option>")
            }
        }
    })
});
$(".order-info").click(function () {
    //alert('dddd');
    $(this).children('.addr').toggle();
});
$(".addadd").click(function () {
    //alert('dddd');

    $(".new_addr").show()
});
$(".addadd").siblings().click(function () {
    //alert('dddd');
    $(".new_addr").hide()
});

$('.addr_show').click(function () {
    $('#choosed')[0].innerHTML=$(this).html();

});




/*
* 提交订单
* 获取订单信息
*
* */


function submitOrder() {
    //获取地址id
    var $addr_id=$('#choosed').find('.addr_id').html();
    if (!$addr_id){
        alert('请选择收货地址！');
    }else {
        location="/index/Check/submit/addr_id/"+$addr_id;
    }


    /*//获取cart_id
    var cartIds=document.getElementsByClassName('c_id');
    var cids=[];
    for (var j=0;j<cartIds.length;j++){
        cids[j]=cartIds[j].innerHTML;
    }

    //获取商品数
    var goods=cids.length;

    //获取订单总价
    var account=$('.account').html();
    console.log(goods,cids,addr_id,account);
    $.ajax({
        type:'post',
        dataType:'json',
        data:{cart_ids:cids,goodsLength:goods,addr_id:addr_id,account:account},
        url:'/index/Check/submit',
        success:function (json) {
            console.log(json.msg);
            //location='/index/Check/index';
        }
    })*/
    



}
