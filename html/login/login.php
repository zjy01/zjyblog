<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="<?php echo __ROOT__; ?>/css/login.css" rel="stylesheet" type="text/css">
    <title>登陆</title>
</head>
<body>
<div class="header">
    <a href="#">回到首页</a>
    <a href="login.php">登陆</a>
</div>
<div class="login-move">
    <div class="login-box">
        <div class="login-header">登　　陆</div>
        <div class="login-container">
            <form action="<?php echo __APP__;?>/login/loginDeal.php" method="post">
                <table cellpadding="10">
                    <tr>
                        <td>用户名：</td>
                        <td><input type="text" name="user_name" class="tr-text haveto" placeholder="输入用户名"></td>
                    </tr>
                    <tr>
                        <td>密码：</td>
                        <td><input type="password" name="password" class="tr-text haveto" placeholder="输入密码"></td>
                    </tr>
                    <tr>
                        <td>记住密码</td>
                        <td>
                            <input type="radio" name="remember" value="0" checked>不
                            <input type="radio" name="remember" value="1">一周
                            <input type="radio" name="remember" value="2">一月
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="登陆" class="login-button log">
                            <input type="button" value="注册" class="login-button reb">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="register-container">
            <form action="<?php echo __APP__;?>/login/register.php" method="post">
                <table cellpadding="10">
                    <tr>
                        <td><span class="red">*</span>用户名：</td>
                        <td width="210">
                            <input type="text" name="userName" class="tr-text haveto" placeholder="用户名一旦确认不可更改">
                            <img src="<?php echo __ROOT__; ?>/images/icon/right.png" class="right">
                            <img src="<?php echo __ROOT__; ?>/images/icon/wrong.png" class="wrong">
                        </td>
                        <td rowspan="2">签名：</td>
                        <td rowspan="2"><textarea rows="4" class="tr-text" name="remark"></textarea></td>
                    </tr>
                    <tr>
                        <td><span class="red">*</span>密码：</td>
                        <td><input type="password" name="password" class="tr-text haveto" placeholder="输入密码"></td>
                    </tr>
                    <tr>
                        <td><span class="red">*</span>确认密码：</td>
                        <td nowrap>
                            <input type="password" name="repassword" class="tr-text haveto" placeholder="再输一次密码">
                            <img src="<?php echo __ROOT__; ?>/images/icon/right.png" class="right">
                            <img src="<?php echo __ROOT__; ?>/images/icon/wrong.png" class="wrong">
                        </td>
                        <td rowspan="2">头像：</td>
                        <td rowspan="2">
                            <img src="<?php echo __ROOT__; ?>/images/face/01.jpg" class="face-img face-now"/>（点击修改）
                            <input type="hidden" name="face" value="../../images/face/01.jpg">
                            <div class="face-box">
                                <div>选择头像</div>
                                <img src="<?php echo __ROOT__; ?>/images/face/01.jpg" class="face-img"/>
                                <img src="<?php echo __ROOT__; ?>/images/face/02.jpg" class="face-img"/>
                                <img src="<?php echo __ROOT__; ?>/images/face/03.jpg" class="face-img"/>
                                <img src="<?php echo __ROOT__; ?>/images/face/04.jpg" class="face-img"/>
                                <img src="<?php echo __ROOT__; ?>/images/face/05.jpg" class="face-img"/>
                                <img src="<?php echo __ROOT__; ?>/images/face/06.jpg" class="face-img"/>
                                <img src="<?php echo __ROOT__; ?>/images/face/07.jpg" class="face-img"/>
                                <img src="<?php echo __ROOT__; ?>/images/face/08.jpg" class="face-img"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>邮箱：</td>
                        <td>
                            <input type="text" name="email" class="tr-text" placeholder="输入邮箱">
                            <img src="<?php echo __ROOT__; ?>/images/icon/right.png" class="right">
                            <img src="<?php echo __ROOT__; ?>/images/icon/wrong.png" class="wrong">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <input type="submit" value="提交" class="login-button register-submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</div>
<div class="footer">

</div>
<script src="<?php echo __ROOT__; ?>/js/jquery-1.11.1.min.js"></script>
<?php echo "<script>var __ROOT__='".__ROOT__."';var __APP__='".__APP__."';</script>"; ?>
<script>
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
        });
        $(".reb").click(function(){
            $(".login-container").hide();
            $(".register-container").fadeIn('fast');
            $(".login-header").text("注　　册");
            $(".login-box").animate({
                'width':640
            });
        });
    });
</script>
</body>
</html>