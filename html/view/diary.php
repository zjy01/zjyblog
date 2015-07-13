<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/12
 * Time: 17:34
 */
$action=empty($_GET['action'])?0:$_GET['action'];
if($action=='add'){
    $content=$_POST['diary_content'];
    if(!empty($_COOKIE['blog_title'])){
        setcookie('blog_title',0,time()-1);
        setcookie('blog_id',0,time()-1);
    }
    $time=time();
    $diary=M("diary");
    $arr['diary_content']=addslashes($content);
    $arr['diary_time']=$time;
    $arr['user_id']=$_SESSION['user_id'];
    $re=$diary->insert($arr)->sql();
    if(!$re){
        _alert("发布失败，请重试");
    }
    header("refresh:0;url=".__APP__."/view/home.php");
}
elseif($action=='delete'){
    $diary_id=$_GET['diary_id'];
    $re=M("diary")->delete()->where("diary_id='".$diary_id."'")->sql();
    echo $re;
}
elseif($action=='attenAdd'){
    $from=$_GET['from'];
    $to=$_GET['to'];
    $arr['at_from']=$from;
    $arr['at_to']=$to;
    $re=M("attention")->insert($arr)->sql();
    echo $re;
}
elseif($action=='attenDel'){
    $from=$_GET['from'];
    $to=$_GET['to'];
    $re=M("attention")->delete()->where("at_from='{$from}' and at_to='{$to}'")->sql();
    echo $re;
}
elseif($action=='longBlog'){
    $content=$_POST['blog_content'];
    $time=time();
    $diary=M("longblog");
    $arr['blog_content']=addslashes($content);
    $arr['blog_title']=$_POST['blog_title'];
    $arr['blog_time']=$time;
    $arr['user_id']=$_SESSION['user_id'];
    $re=$diary->insert($arr)->sql();
    if(!$re){
        _alert("发布失败，请重试");
        echo "<script>history.back();</script>";
    }
    else{
        setcookie('blog_title',$arr['blog_title'],time()+10);
        setcookie('blog_id',$re,time()+10);
        header("location:".__APP__."/view/home.php");
    }
}
elseif($action=='comment'){
    $arr['comment_content']=$_POST['comment'];
    $arr['user_name']=$_POST['from'];
    $arr['diary_id']=$_POST['to'];
    $arr['comment_time']=time();
    $re=M("comment")->insert($arr)->sql();
    if($re){
        echo 1;
    }
    else{
        echo 0;
    }
}