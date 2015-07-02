<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/2
 * Time: 23:27
 */
$username=trim($_POST['user_name']);
$password=md5($_POST['password']);
$user=M("user");
$re=$user->select()->where("user_name='".$username."'")->sql();
if($re){
   if($re[0]['user_password']==$password){
       $_SESSION['user_id']=$re[0]['user_id'];
       $_SESSION['user_name']=$re[0]['user_name'];

       $remember=$_POST['remember'];
       if($remember=='1'){
           setcookie('user_name',$username,time()+3600*24*7);
           setcookie('password',$username,time()+3600*24*7);
       }
       if($remember=='2'){
           setcookie('user_name',$username,time()+3600*24*30);
           setcookie('password',$username,time()+3600*24*30);
       }

       header("location:".__APP__."/index.php");
   }
    else{
        _alert("密码不正确");
        header("refresh:0;url=".__APP__."/login/login.php");
    }
}
else{
    _alert("用户名不存在");
    header("refresh:0;url=".__APP__."/login/login.php");
}
