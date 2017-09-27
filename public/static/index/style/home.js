

var $clickId;
var $clickNum=0;

function passId(goods_id) {
    $clickId=goods_id;
}

$('.cover-inc').click(function () {

    if($(this).siblings('.cover').find('.cover-num')[0].innerHTML>=0){
        $(this).siblings('.cover').find('.cover-num')[0].innerHTML++;
    }

    $clickNum=$(this).siblings('.cover').find('.cover-num').html();

    $clickNum=parseInt($clickNum);
    var $goods_num=$clickNum;
    var $goods_id=$clickId;

    //alert($goods_id+','+$goods_num);return;
    $.ajax({
        type:'post',
        dataType:'json',
        data:{goods_num:$goods_num,goods_id:$goods_id},
        url:"/index/Cart/addInCookie",
        success:function (json) {
            if(json.status=='success'){
                alert(json.msg);
            }
        }
    })
});

$('.cover-dec').click(function () {

    if($(this).siblings('.cover').find('.cover-num')[0].innerHTML>0){
        $(this).siblings('.cover').find('.cover-num')[0].innerHTML--;
    }
    $clickNum=$(this).siblings('.cover').find('.cover-num').html();

    $clickNum=parseInt($clickNum);
    var $goods_num=$clickNum;
    var $goods_id=$clickId;

    //alert($goods_id+','+$goods_num);return;
    $.ajax({
        type:'post',
        dataType:'json',
        data:{goods_num:$goods_num,goods_id:$goods_id},
        url:"/index/Cart/addInCookie",
        success:function (json) {
            if(json.status=='success'){
                alert(json.msg);
            }
        }
    })
});


  /*  function decToCart(goods_id) {
        var goods_num=$('.cover').find('.cover-num')[0].innerHTML;
        var goods_id=goods_id;
        if(goods_num>=1){
            $('.cover').find('.cover-num')[0].innerHTML--;
            $.ajax({
                type:'post',
                dataType:'json',
                data:{goods_num:goods_num,goods_id:goods_id},
                url:"/index/Cart/addInCookie",
                beforeSend:function () {
                    $('.cart_hidden').innerHTML="<p>正在添加商品至购物车...</p>>"
                },
                success:function (json) {
                    if(json.status=='success'){
                        alert(json.msg);
                    }
                }
            })



        }


    }
*/

