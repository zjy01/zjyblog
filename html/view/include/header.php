<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/12
 * Time: 16:27
 */
if(empty($_SESSION['user_id'])){
    header("location:".__APP__.'\login\login.php');
}
$user=M("user")->select()->where("user_id='".$_SESSION['user_id']."'")->sql();
?>
<div class="header">
    <div class="user-header">
        <div class="user-face">
            <img src="<?php echo $user[0]['user_face'];?>">
        </div>
        <a href="<?php echo __APP__; ?>/view/myCenter.php"><?php echo $user[0]['user_name']; ?></a>
        <a href="<?php echo __APP__; ?>/login/logout.php" class="log-out">[注销]</a>
    </div>
    <a href="<?php echo __APP__; ?>/view/home.php">首页</a>
    <a href="<?php echo __APP__; ?>/view/attentionBlog.php">特别关注</a>
    <a href="<?php echo __APP__; ?>/view/myBlog.php">我的博客</a>
    <a href="<?php echo __APP__; ?>/view/myCenter.php">个人中心</a>
</div>