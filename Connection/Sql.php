<?php
namespace User\Connection;
class Sql{

    private static $instance=null;
         private function ConnectUser(){
            $dbms='mysql';     //数据库类型
            $host='localhost'; //数据库主机名
            $dbName='sql';    //使用的数据库
            $user='root';      //数据库连接用户名
            $pass='';          //对应的密码
            $dsn="$dbms:host=$host;dbname=$dbName";
            try {
            $dbh = new \PDO($dsn, $user, $pass, array(\PDO::ATTR_PERSISTENT => true))//初始化一个PDO对象
            or die("链接错误");
            $dbh->query("SET NAMES utf8");
            } catch (\PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
            }
            return $dbh;
        }
       /* private function __construct()
        {
            private static Sql instance=new Sql();
            return $this->$sql->ConnectUser();

        }*/
       private function __construct()
       {
       }

       public static function Conneect(){
            if (is_null ( self::$instance ) || empty(  self::$instance )) {
                self::$instance = new self();
                return self::$instance->ConnectUser();
            }
            return self::$instance->ConnectUser();


        }


}
?>