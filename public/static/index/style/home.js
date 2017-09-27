


    function addToCart(goods_id) {
        var goods_num=$('.cover').find('.cover-num')[0].innerHTML;
        var goods_id=goods_id;

        $('.cover').find('.cover-num')[0].innerHTML++;

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





       /* $('.cover-dec').click(function () {
            if($('.cover').find('.cover-num')[0].innerHTML>=1){
                $('.cover').find('.cover-num')[0].innerHTML--;
            }
        });*/

    }

    function decToCart(goods_id) {
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


