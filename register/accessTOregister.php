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
//header("Content-Type:application/javascript;charset=UTF-8");
@$username=$_REQUEST['username'];
@$password=$_REQUEST['password'];
@$fun=$_REQUEST['callback'];
$conn = mysqli_connect("127.0.0.1", "root", "", "chinamobile", 3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,  $sql);
$sql = "SELECT * FROM `user` WHERE username='".$username."'";
$result = mysqli_query($conn,  $sql);
if($result===false){   //SQL执行失败
    echo "执行失败！请检查SQL语法：$sql";
    var_dump($result);
}else {					//SQL执行成功
    $getData= mysqli_fetch_all($result,MYSQLI_ASSOC);
//    var_dump($getData);
    if(count($getData)){
        $jso=json_encode(['msg'=>'用户名已存在']);
        echo $fun.'('.$jso.')';
//        echo 0;
    }else{
        $pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[\w\W]{8,16}$/";
        preg_match($pattern,$password,$match);
        if($username==""){
            $jso=json_encode(['msg'=>'用户名不能为空']);
            echo $fun.'('.$jso.')';
//            echo 1;
            return;
        }
        if(count($match)==0){
            $jso=json_encode(['msg'=>'密码为包含一个大写字母，一个小写字母和数字，最小8位最长16位！']);
            echo $fun.'('.$jso.')';
//            echo 2;
            return;
        }
        $sql="INSERT INTO `user` VALUES (null,'".$username."','".$password."','null')";
        $result = mysqli_query($conn,  $sql);
        if(!$result){
            echo "执行失败！请检查SQL语法：$sql";
        }else{
            $sql = "SELECT * FROM `user` WHERE username='".$username."'";
            $result = mysqli_query($conn,  $sql);
            $data=mysqli_fetch_assoc($result);
            $_SESSION["ID"]=$data['id'];
            $data['msg']='添加成功';
            $jso=json_encode($data);
            echo $fun.'('.$jso.')';
//            echo 3;
        }
    }
}