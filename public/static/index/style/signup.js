var sms;

function sendSMS() {
    var phone=$('.phonenumber').val();


    //手机号验证
    var phoneReg=/^1[3|4|5|8][0-9]\d{4,8}$/;


    if(!phoneReg.test(phone)){
        alert("请输入正确的手机号!");
    }else {
        $.ajax({
            type:'post',
            dataType:'json',
            data:{phone:phone},
            url:'/index/Signup/send',
            success:function (json) {
                sms=json.sms;
            }
        });
        var seconds=10;
        $('.btna').css('background-color','gray').attr('onclick','');
        count();
        var timer=setInterval(count,1000);
        function count() {
            seconds--;
            $('.yzm').addClass('count-down').html(seconds+'秒后可重新发送');
            if(seconds==0){
                $('.btna').css('background-color','#15374A').attr('onclick','sendSMS()');
                $('.yzm').removeClass('count-down').html('获取短信验证码');
                clearInterval(timer);
            }
        }


    }
}
/*
function smsCheck() {
    if($('.sms').val()==sms){
        $('.sms-right').css('display','inline-block');
        $('.sms-error').css('display','none');
    }else {
        $('.sms-error').css('display','inline-block');
        $('.sms-right').css('display','none');
    }
}*/


function validate() {
    var psw=$('.password').val();
    var pswCon=$('.psw-confirm').val();
    var sms=$('.sms').val();




    //密码格式验证
    var pswReg=/^[a-zA-Z]\w{5,19}$/;
}