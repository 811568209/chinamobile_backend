<?php
/**
 * Created by PhpStorm.
 * User: CONSON
 * Date: 2019/4/3
 * Time: 20:55
 */
session_start();
header("Content-Type:application/javascript;charset=UTF-8");
@$id=$_SESSION["ID"];
@$fun=$_REQUEST["callback"];//jsop固定回调函数名
if($id){
    $conn = mysqli_connect("127.0.0.1", "root", "", "chinamobile", 3306);
    $sql="SET NAMES UTF8";
    mysqli_query($conn,  $sql);
    $sql = "SELECT * FROM `user` WHERE id='".$id."'";
    $result = mysqli_query($conn,  $sql);
    if($result==false){
        echo "执行失败！请检查SQL语法：$sql";
    }else{
        $getData= mysqli_fetch_all($result,MYSQLI_ASSOC);
//        var_dump($getData[0]);
        $getData[0]['msg']='login';
        $jso=json_encode($getData[0]);
        echo $fun.'('.$jso.')';
    }
}else{
    $jso=json_encode(['msg'=>'logout']);
    echo $fun.'('.$jso.')';//jsop固定返回格式
}