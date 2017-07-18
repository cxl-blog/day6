<?php
/**
 * Created by PhpStorm.
 * User: YOGA
 * Date: 2017/7/10
 * Time: 20:49
 */



/*$coon= mysqli_connect("localhost","root","","sql1")
or die("连接错误");

//mysql_select_db("sql1",$conn);
$coon->query("SET NAMES UTF8");
*/


$dbms='mysql';     //数据库类型
$host='localhost'; //数据库主机名
$dbName='user-manage-system';    //使用的数据库
$user='root';      //数据库连接用户名
$pass='root';          //对应的密码
$dsn="$dbms:host=$host;dbname=$dbName";


try {
    $dbh = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true))//初始化一个PDO对象
    or die("链接错误");
    $dbh->query("SET NAMES utf8");
    echo ('cheng');
    //echo "连接成功<br/>";
    /*你还可以进行一次搜索操作
    foreach ($dbh->query('SELECT * from FOO') as $row) {
        print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
    }
    */

} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}
/*
$sql = "SELECT * FROM `users`";
/////$dbh->exec($sql);
$resquest=$dbh->query($sql);
$num=$resquest->rowCount();
echo $num."+";
foreach($resquest as $row){
  $name=$row['name'];
  $password=$row['password'];
  echo "ni$password"."<br/>";

}


*/





?>