<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/1
 * Time: 19:51
 */
//开启session
session_start();

//连接数据库
mysql_connect('localhost','root','111111') or die('连接数据库服务器失败');
mysql_select_db('zjyblog') or die('链接数据库 zjyblog 失败');
mysql_query("set names 'utf8'");