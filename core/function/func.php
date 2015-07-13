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

function _code($_width = 75,$_height = 25, $_rnd_code=4,$_flag = FALSE){
    $_nmsg='';
    for($i=0;$i<$_rnd_code;$i++){
        $_nmsg .= dechex(mt_rand(0,15));
    }
    $_SESSION['code']=$_nmsg;
    $_img =imagecreatetruecolor($_width, $_height);
    $_white = imagecolorallocate($_img, 255, 255, 255);
    imagefill($_img, 0, 0, $_white);
    if ($_flag){
        $_black =imagecolorallocate($_img, 0, 0, 0);
        imagerectangle($_img, 0, 0, $_width-1, $_height-1, $_black);
    }
    for($i=0;$i<6;$i++){
        $_rnd_color = imagecolorallocate($_img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($_img, mt_rand(0, $_width), mt_rand(0, $_height), mt_rand(0, $_width), mt_rand(0, $_height), $_rnd_color);
    }
    for($i=0;$i<100;$i++){
        $_rnd_color = imagecolorallocate($_img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
        imagestring($_img, 1, mt_rand(1, $_width), mt_rand(1, $_height), "*", $_rnd_color);
    }
    for($i=0;$i<strlen($_SESSION['code']);$i++){
        $_rnd_color = imagecolorallocate($_img, mt_rand(0, 100), mt_rand(0, 150), mt_rand(0, 200));
        imagestring($_img, 5, $i*$_width/$_rnd_code+mt_rand(1, 10), mt_rand(1, $_height/2), $_SESSION['code'][$i], $_rnd_color);
    }
    header('Content-Type: image/png');
    imagepng($_img);
    imagedestroy($_img);
}
function selectComment($diary){
    $re=M("comment")->select()->where("diary_id='{$diary}'")->orderby('comment_time','asc')->sql();
    if(!is_array($re)){
        $re=array();
    }
    $data['count']=count($re);
    $data['comment']=$re;
    return $data;
}