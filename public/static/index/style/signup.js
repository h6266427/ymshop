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
                console.log(sms);
            }
        });
        var seconds=60;
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
    var phone=$('.phonenumber').val();
    var psw=$('.password').val();
    var pswCon=$('.psw_confirm').val();
    var smsCon=$('.sms').val();

    //手机号验证
    var phoneReg=/^1[3|4|5|8][0-9]\d{4,8}$/;

    //密码格式验证
    var pswReg=/^[a-zA-Z]\w{5,19}$/;

    if(!phoneReg.test(phone)){
        alert('请输入正确的手机号！');
    }else {
        if(!pswReg.test(psw)){
            alert('请输入6-20位以字母开头包含数字的密码！');
        }else {
            if(pswCon!=psw){
                alert('两次输入的密码不一致！');
            }else {
                if(smsCon!=sms){
                    alert('短信验证码输入错误！');
                }else {
                    $.ajax({
                        type:"post",
                        dataType:'json',
                        data:{username:phone,password:psw},
                        url:"/index/Signup/signUp",
                        success:function (json) {
                            alert(json.msg);
                        }
                    })
                }
            }
        }
    }

}