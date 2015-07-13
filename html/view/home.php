<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!--    css begin-->
    <?php include 'include/css.php'; ?>
<!--    css end-->
    <title>首页</title>
</head>
<body>
<!--header begin-->
<?php include 'include/header.php'; ?>
<!--header end-->

<!--分页-->
<?php
$page=empty($_GET['p'])?0:$_GET['p'];
$num=15;

$diary=M("diary,user");
$diaryAll=$diary->select("count(diary_id) as count")->where('diary.user_id=user.user_id')->sql();
//总数
$allNum=$diaryAll[0]['count'];

//分页查询
$diaryArr=$diary->select()->where('diary.user_id=user.user_id')->orderby('diary_time','desc')->limit($page*$num,$num)->sql();

//简单分页链接
$prev="<a href='".__APP__."/view/home.php?p=".($page-1)."'>上一页</a>";
$next="<a href='".__APP__."/view/home.php?p=".($page+1)."'>下一页</a>";
$link='';
if($page>0){
    $link.=$prev;
}
if(($page+1)*$num<$allNum){
    $link.=$next;
}

//总共写了多少条
$count=M("diary")->select("count(diary_id) as count")->where("user_id='".$_SESSION['user_id']."'")->sql();
?>

<?php
//关注
$attention=M("attention");
$atten=$attention->select('at_to')->where("at_from='".$_SESSION['user_id']."'")->sql();
$att=array();
if($atten){
    foreach($atten as $v){
        $att[]=$v['at_to'];
    }
}

//长微博编辑后的小短语
$longblog='';
if(!empty($_COOKIE['blog_title'])){
    $longblog="我编写了长篇博客<a target='_blank' href='".__APP__."/view/blogView.php?blog_id=".$_COOKIE['blog_id']."'>《".$_COOKIE['blog_title']."》</a>，快近来看看吧";
}
?>
<!--diary select end-->
<div class="container">
    <div class="diary-part">
        <form method="post" action="<?php echo __APP__; ?>/view/diary.php?action=add">
            <table border="0">
                <tr>
                    <td class="diary-left">
                        <p>-----------记录生活点点滴滴-----------</p>
                    </td>
                    <td rowspan="3" class="diary-right" valign="center" align="center">
                        <div class="diary-count">
                            <div>心路历程</div>
                            <span><b id="diary-count"><?php echo $count[0]['count'] ?></b>条</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea id="simple-type" name="diary_content"><?php echo $longblog; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            已输入<b id="simple-count"></b>/140个字　<span class="red"></span>
                            <a class="simple-sub btn bg-primary" href="<?php echo __APP__; ?>/view/longBlog.php">编辑长篇博客</a>
                            <input type="submit" class="simple-sub btn btn-success short-sub" value="发表">
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="diary-show">
        <?php foreach($diaryArr as $index=>$value):?>
        <div class="diary-show-one">
            <div class="diary-show-content">
                <div class="diary-user-face">
                    <img src="<?php echo $value['user_face']; ?>">
                    <div>
                        <span><?php echo $value['user_name']; ?></span>
                        <span><?php echo date('Y-m-d H:i',$value['diary_time']);?></span>
                        <?php if($_SESSION['user_id']!=$value['user_id']){ ?>
                        <?php if(!in_array($value['user_id'],$att)){?>
                        <span><a class="attenAdd" data-from="<?php echo $_SESSION['user_id']; ?>" data-to="<?php echo $value['user_id']; ?>">关注</a></span>
                        <?php } else { ?>
                        <span><a class="attenDel" data-from="<?php echo $_SESSION['user_id']; ?>" data-to="<?php echo $value['user_id']; ?>">取消关注</a></span>
                        <?php } ?>
                        <?php } else { ?>
                            <span class="red diary-delete" data-ms="<?php echo $value['diary_id']; ?>">删除</span>
                        <?php } ?>
                    </div>
                </div>
            <?php
            //查询评论
            $reC=selectComment($value['diary_id']);
            ?>
                <div class="diary-show-word">
                    <div class="diary-show-word-content">
                        <?php echo $value['diary_content']; ?>
                    </div>
                    <div class="comment-button">
                        <img src="../../images/view/dMessages.png">
                        评论（<?php echo $reC['count']; ?>）
                    </div>
                </div>
                <div class="diary-comment-box">
                    <div class="diary-comment-list">
                        <?php
                        foreach($reC['comment'] as $reV):
                        ?>
                        <div class="alert-success">
                            <span>@<?php echo $reV['user_name'];?></span>
                            <?php echo $reV['comment_content']; ?>
                        </div>
                        <?php endforeach; ?>

                    </div>
                    <form action="<?php echo __APP__; ?>/view/diary.php?action=comment">
                        <input class="input-sm" type="text" name="comment">
                        <input type="hidden" name="from" value="<?php echo $user[0]['user_name'];?>">
                        <input type="hidden" name="to" value="<?php echo $value['diary_id'];?>">
                        <button type="submit" class="btn btn-primary comment-submit">评论</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="page-box">
            <?php echo $link; ?>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>
</body>
<!--js begin-->
<?php include 'include/js.php'; ?>
<!--js end-->
</html>