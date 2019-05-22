<?php
/**
 * Created by PhpStorm.
 * User: CONSON
 * Date: 2019/4/3
 * Time: 20:55
 */
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");


@$pagesize=$_REQUEST['pagesize'];
@$nowpage=$_REQUEST['nowpage'];

echo $nowpage;
