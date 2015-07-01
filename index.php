<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/6/28
 * Time: 22:02
 */
if(!$_SESSION['user_id']){
    header('location:html/login/login.html');
}
else{
    header('location:html/view/index.php');
}