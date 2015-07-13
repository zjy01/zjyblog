<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!--    css begin-->
    <?php include 'include/css.php'; ?>
    <!--    css end-->
    <title>长篇博客编辑区</title>
</head>
<body>
<!--header begin-->
<?php include 'include/header.php'; ?>
<!--header end-->、
<div class="container">
    <form action="<?php echo __APP__; ?>/view/diary.php?action=longBlog" method="post">
        <p>-------------编辑你的长微博，分享你的世界-------------</p>
        <textarea id="longBlog" name="blog_content">
        </textarea>
        <input type="submit" value="提交" class="btn btn-success long-sub" style="margin: 10px auto; display: block; width: 70px;">
        <p class="red" style="text-align: center">提交以后，不要忘了再在首页按“发表”哦</p>
    </form>
</div>
<?php include 'include/footer.php'; ?>
</body>
<!--js begin-->
<?php include 'include/js.php'; ?>
<!--js end-->
</html>