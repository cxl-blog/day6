<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-11
 * Time: 下午2:43
 */
header("Content-type: text/html; charset=utf-8");
include "2coon.php";
$sql="INSERT INTO `user` ( `name`,`sex`, `age`,`comment`) VALUES ('$_POST[name]','$_POST[sex]','$_POST[age]','$_POST[comment]')";
if($dbh->query($sql))
{
    echo "新增成功，即将跳转.....";
    header("Refresh:3; url=css.html");
}
?>