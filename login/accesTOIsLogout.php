<?php
/**
 * Created by PhpStorm.
 * User: CONSON
 * Date: 2019/4/3
 * Time: 20:55
 */
session_start();
//header("Access-Control-Allow-Origin:http://localhost:8080"); ////http://localhost:8080,http://2444f679p9.wicp.vip:37469
//header('Access-Control-Allow-Credentials:true');
//header("Access-Control-Allow-Methods:*");
header("Content-Type:application/javascript;charset=UTF-8");
@$fun=$_REQUEST["callback"];//jsop固定回调函数名
$_SESSION["ID"]=null;
//echo "logout";
echo $fun."('logout')";