<?php
/**
 * Created by PhpStorm.
 * User: CONSON
 * Date: 2019/4/3
 * Time: 20:55
 */
session_start();
//header("Access-Control-Allow-Origin:http://localhost:8080");  ////http://localhost:8080,http://2444f679p9.wicp.vip:37469
//header('Access-Control-Allow-Credentials:true');
//header("Access-Control-Allow-Methods:*");
header("Content-Type:application/javascript;charset=UTF-8");
@$username=$_REQUEST['username'];
@$password=$_REQUEST['password'];
@$fun=$_REQUEST['callback'];
$conn = mysqli_connect("127.0.0.1", "root", "", "chinamobile", 3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,  $sql);
$sql = "SELECT * FROM `user` WHERE username='".$username."' and password='".$password."'";
$result = mysqli_query($conn,  $sql);
if($result===false){   //SQL执行失败
    echo "执行失败！请检查SQL语法：$sql";
    var_dump($result);
}else {					//SQL执行成功
//    echo "执行成功！请到数据库中查看";
    $getData= mysqli_fetch_all($result,MYSQLI_ASSOC);
    if(count($getData)){
        $_SESSION["ID"]=$getData[0]['id'];
        $getData[0]['msg']='login ok';
//        echo json_encode($getData[0]);
        $jso=json_encode($getData[0]);
        echo $fun."(".$jso.")";
    }else{
//        echo json_encode(['msg'=>'用户名或密码错误！']);
        $jso=json_encode(['msg'=>'用户名或密码错误！']);
        echo $fun."(".$jso.")";
		 $_SESSION["ID"]=null;
    }
}