<?php
/**
 * Created by PhpStorm.
 * User: CONSON
 * Date: 2019/4/3
 * Time: 20:55
 */
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
$conn = mysqli_connect("127.0.0.1", "root", "", "chinamobile", 3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,  $sql);
$sql = "SELECT * FROM `f5_2`";
$result = mysqli_query($conn,  $sql);
if($result===false){   //SQL执行失败
    echo "执行失败！请检查SQL语法：$sql";
    var_dump($result);
}else {					//SQL执行成功
//    echo "执行成功！请到数据库中查看";
    $getData= mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($getData);
}