$(function () {

    //设置所有商品里的商品背景图片
    var pImg=document.getElementsByClassName('product_icon');
    for(var i=0;i<pImg.length;i++){
        pImg[i].style.backgroundImage="url('/static/index/img/products_img"+(i+1)+".jpg')";
    }



    //菜单滚动效果
    var p=0,t=0;
    $(window).scroll(function () {

        if(window.scrollY>=80){
            p=$(this).scrollTop();
            if(t<p){
                //向下滚
                $('.ym_head').removeClass('ym_head_scroll');

            }else{
                //向上滚
                $('.ym_head').addClass('ym_head_scroll');

            }
            t=$(this).scrollTop();

        }else {
            //当到顶部时，样式高度回到80px，去除类名；
            $('.ym_head').removeClass('ym_head_scroll');
        }





    })









})