<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/6/28
 * Time: 22:02
 */
include 'core/common.php';
if(empty($_SERVER['PATH_INFO'])){
    header("location:".__APP__."/index.php");
}
else{
    if($_SERVER['PATH_INFO']=='/html' || $_SERVER['PATH_INFO']=='/html/' ){
        header("location:".__APP__."/index.php");
    }
    else{
        include_once($_SERVER['PATH_INFO']);
    }
}

//var_dump($_COOKIE);