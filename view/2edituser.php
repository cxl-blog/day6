<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-11
 * Time: 下午2:15
 */
header("Content-type: text/html; charset=utf-8");
include "2coon.php";
$sql="UPDATE `user` SET `name`='$_POST[name]',`sex`='$_POST[sex]',`age`='$_POST[age]',`comment`='$_POST[comment]' WHERE id='$_POST[id]'";
if($dbh->query($sql)) {
    echo "修改成功，即将跳转。。。。";
    header("Refresh:5; url=css.html");
}
?>