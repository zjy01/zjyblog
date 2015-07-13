/**
 * Created by zjy on 2015/7/12.
 */
$(function(){
    $(".face-now").click(function(){
        var face=$(this);
        var box=$(".face-box");
        box.stop(false,true).slideDown();
        var img=box.find('.face-img');
        img.click(function(){
            var src=$(this).attr('src');
            face.attr('src',src);
            $("input[name='face']").val(src);
            box.stop(false,true).slideUp('fast');
        });
    });
    $(".log").click(function() {
        var st = 1;
        $(this).closest("form").find(".haveto").each(function (i, v) {
            if ($(v).val() == '') {
                st = 0;
                alert('必填项不能留空');
                $(v).focus();
                return false;
            }
        });
        if(st==0){
            return false;
        }
    });
    var a= 1,b= 1,c=1;
    $(".register-submit").click(function(){
        var st=1;
        $(this).closest("form").find(".haveto").each(function(i,v){
            if($(v).val()==''){
                st=0;
                alert('必填项不能留空');
                $(v).focus();
                return false;
            }
        });
        if(a==0){
            alert("用户名已被占用");
        }
        else if(b==0){
            alert("两次输入密码不相同");
        }
        else if(c==0){
            alert("邮箱格式不正确");
        }
        if(st==0 || b==0 || c==0 || a==0){
            return false;
        }
    });
    $("input[name='userName']").focusout(function(){
        var name=$(this).val();
        var bt=$(this);
        if($.trim(name)==''){
            $(this).closest('td').find(".right").hide();
            $(this).closest('td').find(".wrong").show();
        }
        else{
            $.ajax({
                url:__APP__+'/login/verify.php',
                data:{
                    'verify':1,
                    'userName':$.trim(name)
                },
                success:function(data){
                    if(data==1){
                        a=1;
                        bt.closest('td').find(".wrong").hide();
                        bt.closest('td').find(".right").show();
                    }
                    else{
                        a=0;
                        bt.closest('td').find(".right").hide();
                        bt.closest('td').find(".wrong").show();
                    }
                }
            });
        }
    });
    $("input[name='repassword']").focusout(function(){
        var password=$(this).closest('form').find("input[name='password']").val();
        var repassword=$("input[name='repassword']").val();
        if(password==repassword && password!=''){
            b=1;
            $(this).closest('td').find(".wrong").hide();
            $(this).closest('td').find(".right").show();
        }
        else{
            b=0;
            $(this).closest('td').find(".right").hide();
            $(this).closest('td').find(".wrong").show();
        }
    });
    $("input[name='email']").focusout(function(){
        var text=$(this).val();
        var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        if(text!=''){
            if(!pattern.test(text)){
                c=0;
                $(this).closest('td').find(".right").hide();
                $(this).closest('td').find(".wrong").show();
            }
            else{
                c=1;
                $(this).closest('td').find(".wrong").hide();
                $(this).closest('td').find(".right").show();
            }
        }
    });
    $(".reb").click(function(){
        $(".login-container").hide();
        $(".register-container").fadeIn('fast');
        $(".login-header").text("注　　册");
        $(".login-box").animate({
            'width':640
        });
    });
    $("#code").click(function () {
        $(this).attr('src',__APP__+'/view/include/code.php?tm='+Math.random());
    });
});