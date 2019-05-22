<?php
/**
 * Created by PhpStorm.
 * User: CONSON
 * Date: 2019/4/3
 * Time: 20:55
 */
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");

$output=[];
$totlerow=0;
$pagesize=0;
$totlepage=0;
$nowpage=0;

@$pagesize=$_REQUEST['pagesize'];
@$nowpage=$_REQUEST['nowpage'];


$pagesize==null && $pagesize=5;
$nowpage==null && $nowpage=1;

$conn = mysqli_connect("127.0.0.1", "root", "", "chinamobile", 3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,  $sql);
$sql = "SELECT * FROM `f6_like`";
$result = mysqli_query($conn,  $sql);
if($result===false){   //SQL执行失败
    echo "执行失败！请检查SQL语法：$sql";
    var_dump($result);
}else {					//SQL执行成功
//    echo "执行成功！请到数据库中查看";
    $getData= mysqli_fetch_all($result,MYSQLI_ASSOC);
    $totlerow=count($getData);
    $totlepage=ceil($totlerow/$pagesize);
}
$star=($nowpage-1)*$pagesize;
$end=$pagesize;
$sql = "SELECT * FROM `f6_like` limit ".$star." , ".$end;
$result = mysqli_query($conn,$sql);
$getData= mysqli_fetch_all($result,MYSQLI_ASSOC);

$output=[
  [
      "totlerow"=>$totlerow,
      "pagesize"=>$pagesize,
      "totlepage"=>$totlepage,
      "nowpage"=>$nowpage
  ],
    $getData
];
echo json_encode($output);
/*
总行
每页多少
总页
当前页码
*/
