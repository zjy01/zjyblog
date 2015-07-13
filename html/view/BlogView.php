<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!--    css begin-->
    <?php include 'include/css.php'; ?>
    <!--    css end-->
    <title>长篇博客展示区</title>
</head>
<body>
<!--header begin-->
<?php include 'include/header.php'; ?>
<!--header end-->
<div class="container">
    <?php
    $blog_id=$_GET['blog_id'];
    $re=M("longblog,user")->select()->where("blog_id='{$blog_id}' and longblog.user_id=user.user_id")->sql();
    if(!$re){
        exit("长微博获取失败");
    }
    ?>
    <p class="blog-title"><?php echo $re[0]['blog_title'];?></p>
    <p class="blog-ms"><span><?php echo $re[0]['user_name'];?></span><span><?php echo date('Y-m-d',$re[0]['blog_time']);?></span></p>
    <div>
        <?php echo $re[0]['blog_content'];?>
    </div>
</div>
<?php include 'include/footer.php'; ?>
</body>
<!--js begin-->
<?php include 'include/js.php'; ?>
<!--js end-->
</html>