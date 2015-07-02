<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/2
 * Time: 17:40
 */
$name=trim($_POST['userName']);
$password=trim($_POST['password']);
$repassword=trim($_POST['repassword']);
$email=trim($_POST['email']);
$remark=trim($_POST['remark']);
$face=trim($_POST['face']);

$arr['user_name']=$name;
$arr['user_password']=md5($password);
$arr['user_email']=md5($email);
$arr['user_remark']=md5($remark);
$arr['user_face']=md5($face);

if($password!=$repassword){
    _alert("两次密码不一致");
    header("refresh:0;url=".__APP__."/login/login.php");
}
else{
    $user=M("user");
    $id=$user->insert($arr)->sql();

    header("refresh:3;url=".__APP__."/login/login.php");

    print("注册成功，请登陆");
}