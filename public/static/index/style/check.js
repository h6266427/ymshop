

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
$(".deeper").click(function () {
    //alert('dddd');
    $(this).children('.addr').toggle()
});
$(".addadd").click(function () {
    //alert('dddd');

    $(".new_addr").show()
});
$(".addadd").siblings().click(function () {
    //alert('dddd');
    $(".new_addr").hide()
});
