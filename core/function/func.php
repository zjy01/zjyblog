<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/1
 * Time: 1:32
 */
function M($table){
    $d=new table($table);
    return $d;
}
function _alert($words){
    echo "<script>alert('$words');</script>";
}