<?php
/**
 * Created by PhpStorm.
 * User: CONSON
 * Date: 2019/4/3
 * Time: 20:55
 */
session_start();
//$allow_origin = array(
//    'http://localhost:8080',
//    'http://2444f679p9.wicp.vip:37469:8080',
//    'http://51271f1.cpolar.io',
//    'https://51271f1.cpolar.io'
//);
//$allow='';
//if(count($allow_origin)){
//    foreach ($allow_origin as $elem){
//        $allow=$allow.$elem.",";
//    }
//}
//echo $allow;
header("Access-Control-Allow-Origin:http://localhost:8080");
header("Access-Control-Allow-Headers:Content-Type,XFILENAME,XFILECATEGORY,XFILESIZE");
header('Access-Control-Allow-Credentials:true');
header("Access-Control-Allow-Methods:*");
header("Content-Type:application/json;charset=UTF-8");
@$id=$_SESSION["ID"];

// 设置允许访问的域名数组


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
        echo json_encode($getData[0]);
    }
}else{
    echo json_encode(['msg'=>'logout']);
}