<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/1
 * Time: 19:49
 */
include 'config/config.php';
header("Content-Type: text/html; charset=utf-8");
include 'class/table.class.php';
include 'function/func.php';

$u=explode('/index.php',$_SERVER['SCRIPT_NAME'],'2');
define("__ROOT__",$u[0]);
define("__APP__",$u[0]."/index.php/html");