<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/2
 * Time: 16:58
 */
if($_GET['verify']){
    $user=M("user");
    $userName=urldecode($_GET['userName']);
    $re=$user->select('user_id')->where("user_name='$userName'")->sql();
    if($re){//已注册
        if($re[0]['user_id']==$_SESSION['user_id']){
            echo 1;
        }
        else{
            echo 0;
        }
    }
    else{
        echo 1;
    }
}