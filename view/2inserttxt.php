<?php
/**
 * Created by PhpStorm.
 * User: YOGA
 * Date: 2017/7/3
 * Time: 8:58
 */
header("Content-TYpe:text/html;charset=utf-8");//倒入文件内部内容
include "../2coon.php";
$fp=file("../../user.txt/user.txt") or die("打开失败");
var_dump($fp);
$sql="SELECT * FROM `user`";
$qurr=$dbh->query($sql);
for($i=0;$i<count($fp);$i++)
{
    $b=0;
    $str=$fp[$i];
    $val=explode("|",$str);
    while ($row=$qurr->fetch(PDO::FETCH_ASSOC))
    {
        if($row['name']==$val[0]&&$row['sex']==$val[1]&&$row['age']==$val[2]&&$row['comment']==$val[3]) {
            $b++;

        }

    }
    var_dump($b);
    if($b==0)
    {
        $sql="INSERT INTO `user` ( `name`,`sex`, `age`,`comment`) VALUES ('$val[0]','$val[1]','$val[2]','$val[3]')";
        if($dbh->query($sql))
            echo "添加成功";

    }
    else
        echo "文件内部暂无新用户";
    /*$sql = "INSERT INTO user( id,name,sex,age,comment) VALUE ('','$val[0]','$val[1]','$val[2]','$val[3])";
    $dbh->query($sql);*/
}





?>