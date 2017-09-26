


    function addToCart(goods_id) {
        var gnum=$('.cover').find('.cover-num')[0].innerHTML;
        var gid=goods_id;

        $('.cover').find('.cover-num')[0].innerHTML++;

        $.ajax({
            type:'post',
            dataType:'json',
            data:{gunm:gnum,gid:gid},
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
        var gnum=$('.cover').find('.cover-num')[0].innerHTML;
        var gid=goods_id;
        if(gnum>=1){
            $('.cover').find('.cover-num')[0].innerHTML--;
            $.ajax({
                type:'post',
                dataType:'json',
                data:{gunm:gnum,gid:gid},
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


