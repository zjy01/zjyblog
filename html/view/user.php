<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/13
 * Time: 1:23
 */
$action=empty($_GET['action'])?0:$_GET['action'];
if($action=='change'){
    $name=$_POST['userName'];
    $user=M("user");
    $re=$user->select('user_id')->where("user_name='$name'")->sql();
    if($re){//已注册
        if($re[0]['user_id']!=$_SESSION['user_id']){
            _alert("用户名已存在");
            echo "<script>history.go(-1);</script>";
            exit;
        }
    }
    $arr['user_name']=$name;
    $arr['user_face']=$_POST['face'];
    $arr['user_email']=$_POST['email'];
    $arr['user_remark']=$_POST['remark'];
    $user->update($arr)->where("user_id='{$_SESSION['user_id']}'")->sql();
    _alert("修改成功");
    echo "<script>location.replace(document.referrer);</script>";
}
elseif($action=='password'){
    $oldpassword=$_POST['oldpassword'];
    $user=M("user");
    $re=$user->select('user_id')->where("user_password='".md5($oldpassword)."'")->sql();
    if($re){//密码正确
        $newpassword=$_POST['password'];
        $repassword=$_POST['repassword'];
        if($newpassword!=$repassword){
            _alert("两次密码不一致");
            echo "<script>history.go(-1);</script>";
        }
        else{
            $arr['user_password']=md5($newpassword);
            $user->update($arr)->where("user_id='{$_SESSION['user_id']}'")->sql();
            _alert("密码修改成功，请重新登陆");
            header("refresh:0;url=".__APP__."/login/logout.php");
        }
    }
    else{
        _alert("原密码不正确，请重试");
        echo "<script>history.go(-1);</script>";
    }
}