<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/2
 * Time: 16:37
 */
if(defined("__APP__")){
    if(empty($_SESSION['user_id'])){
        header("location:".__APP__.'\login\login.php');
    }
    else{
        print("已登陆");
        var_dump($_COOKIE);
    }
}
else{
    echo "You do not have permission";
}