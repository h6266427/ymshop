function preview(file) {
    /*
    * 预览上传图片的JS方法
    * */

    var prevDiv=document.getElementById('preview');
    if (file.files &&file.files[0]){
        var reader=new FileReader();
        reader.onload=function (evt) {
            prevDiv.innerHTML='<img src="' + evt.target.result + '" />';
        };
        reader.readAsDataURL(file.files[0]);

    }else {

        prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
    }


}