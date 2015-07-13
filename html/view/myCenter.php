<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!--    css begin-->
    <?php include 'include/css.php'; ?>
<!--    css end-->
    <title>个人中心</title>
</head>
<body>
<!--header begin-->
<?php include 'include/header.php'; ?>
<!--header end-->
<?php
$user=M("user")->select()->where("user_id='{$_SESSION['user_id']}'")->sql();
$user=$user[0];

//博客数
$diary=M("diary")->select("count(diary_id) as count")->where("user_id='{$_SESSION['user_id']}'")->sql();
$blog=M("longblog")->select("count(blog_id) as count")->where("user_id='{$_SESSION['user_id']}'")->sql();
$bm=$diary[0]['count'].' / '.$blog[0]['count'];

//关注数
$from=M("attention")->select("count(at_to) as count")->where("at_from='{$_SESSION['user_id']}'")->sql();
$to=M("attention")->select("count(at_to) as count")->where("at_to='{$_SESSION['user_id']}'")->sql();
$am=$from[0]['count'].' / '.$to[0]['count'];

?>
<div class="container">
    <p class="blog-title">个人中心</p>
    <p style="text-align: center">
        <span class="change-ms">修改资料</span>
        <span class="change-pw">修改密码</span>
    </p>
    <table border="0" class="user-table table-bordered table-condensed">
        <tr class="info">
            <td rowspan="5" width="250" align="center"><img src="<?php echo $user['user_face']; ?>" class="big-face"></td>
            <td width="350" class="alert-success">用户名：<?php echo $user['user_name']; ?></td>
        </tr>
        <tr class="alert-info">
            <td>邮箱：<?php echo $user['user_email']; ?></td>
        </tr>
        <tr>
            <td  class="bg-primary">微博/长篇数：<?php echo $bm; ?></td>
        </tr>
        <tr>
            <td class="alert-warning">关注/被关注数：<?php echo $am; ?></td>
        </tr>
        <tr>
            <td class="bg-danger">备注：<?php echo $user['user_remark']; ?></td>
        </tr>
    </table>
    <form action="<?php echo __APP__;?>/view/user.php?action=change" method="post">
    <table border="0" class="ms-table table-bordered table-condensed">
        <tr class="info">
            <td rowspan="3" width="250" align="center" style="position: relative">
                <img src="<?php echo $user['user_face']; ?>" class="big-face face-now">
                <span>（点击修改）</span>
                <input type="hidden" name="face" value="<?php echo $user['user_face']; ?>">
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
            <td width="350" class="alert-success" height="55">
                用户名：<input name="userName" value="<?php echo $user['user_name']; ?>" class="haveto"/>
                <img src="<?php echo __ROOT__; ?>/images/icon/right.png" class="right">
                <img src="<?php echo __ROOT__; ?>/images/icon/wrong.png" class="wrong">
            </td>
        </tr>
        <tr>
            <td  class="alert-info" height="55">
                邮箱：　<input name="email" value="<?php echo $user['user_email']; ?>"/>
                <img src="<?php echo __ROOT__; ?>/images/icon/right.png" class="right">
                <img src="<?php echo __ROOT__; ?>/images/icon/wrong.png" class="wrong">
            </td>
        </tr>
        <tr>
            <td class="bg-danger">备注：　<textarea name="remark" class="user-remark"><?php echo $user['user_remark']; ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2" class="alert-warning" style="text-align: center">
                <button type="submit" class="btn-info btn change-submit">修改</button>
            </td>
        </tr>
    </table>
    </form>

    <form action="<?php echo __APP__;?>/view/user.php?action=password" method="post">
        <table border="0" class="pw-table table-bordered table-condensed">
            <tr class="info">
                <td rowspan="5" width="250" align="center"><img src="<?php echo $user['user_face']; ?>" class="big-face"></td>
                <td width="350" class="alert-success">用户名：三三四四</td>
            </tr>
            <tr>
                <td class="alert-info">
                    原密码：　<input type="password" name="oldpassword" class="input-sm haveto">
                </td>
            </tr>
            <tr>
                <td  class="bg-primary">
                    新密码：　<input type="password" name="password" class="input-sm haveto" style="color: #000000">
                </td>
            </tr>
            <tr>
                <td class="alert-warning">
                    确认密码：<input type="password" name="repassword" class="input-sm haveto">
                    <img src="<?php echo __ROOT__; ?>/images/icon/right.png" class="right">
                    <img src="<?php echo __ROOT__; ?>/images/icon/wrong.png" class="wrong">
                </td>
            </tr>
            <tr>
                <td class="bg-danger" style="text-align: center">
                    <button type="submit" class="btn-info btn password-submit">修改</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include 'include/footer.php'; ?>
</body>
<!--js begin-->
<?php include 'include/js.php'; ?>
<!--js end-->
</html>