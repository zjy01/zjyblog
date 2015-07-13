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
    <a href="login.php">登陆</a>
</div>
<?php
$username='';
$password='';
if(isset($_COOKIE['user_name'])){
    $username=$_COOKIE['user_name'];
}
if(isset($_COOKIE['password'])){
    $password=$_COOKIE['password'];
}
?>
<div class="login-move">
    <div class="login-box">
        <div class="login-header">登　　陆</div>
        <div class="login-container">
            <form action="<?php echo __APP__;?>/login/loginDeal.php" method="post">
                <table cellpadding="10">
                    <tr>
                        <td>用户名：</td>
                        <td><input type="text" name="user_name" class="tr-text haveto" placeholder="输入用户名" value="<?php echo $username; ?>"></td>
                    </tr>
                    <tr>
                        <td>密码：</td>
                        <td><input type="password" name="password" class="tr-text haveto" placeholder="输入密码" value="<?php echo $password; ?>"></td>
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
                        <td>验证码：</td>
                        <td valign="center" class="codeTd">
                            <input type="text" size="3" class="haveto" name="code">
                            <img src="<?php echo __APP__;?>/view/include/code.php" id="code">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="登陆" class="login-button log login-submit">
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
<div class="footer">ZJYBLOG Copyright©<b>张嘉永 20131003637</b></div>
<script src="<?php echo __ROOT__; ?>/js/jquery-1.11.1.min.js"></script>
<?php echo "<script>var __ROOT__='".__ROOT__."';var __APP__='".__APP__."';</script>"; ?>
<script src="<?php echo __ROOT__; ?>/js/login.js"></script>
</body>
</html>