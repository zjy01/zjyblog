<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/2
 * Time: 16:37
 */
if(defined("__APP__")){
    header("location:".__APP__.'\view\home.php');
}
else{
    echo "You do not have permission";
}