<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-13
 * Time: 上午9:54
 */
namespace User\Dao;
use User\Connection\Sql;
class UserDao{
    /*function mysql(){
        $mysql=Sql::Conneect();
        return $mysql;
    }*/
    private $mysql;
    function __construct()
    {
        $this->mysql=Sql::Conneect();
    }

    function getUser($id){//id查询单行
        $dbh=$this->mysql;
        $sql="SELECT * FROM `user` WHERE  id= ? ";

        $a=$dbh->prepare($sql);
        $a->execute(
            array($id)
        );
        $string=$a->fetchAll(\PDO::FETCH_ASSOC);
        return $string;
    }
    function findUserByname($name,$offset,$pagesize){//多行查询
        $conn =$this->mysql;

        $sql="SELECT * FROM `user` WHERE  name='$name'  LIMIT $offset,$pagesize";
        $str=$conn->query($sql);

       $row=array();
       while ($qurr=$str->fetch(\PDO::FETCH_ASSOC))
       {
       $row[]=$qurr;
       }
        return $row;
    }

    function getCount($name,$sex,$agel,$ager)
    {
        if((!empty($sex))&&(!empty($ager))&&(!empty($agel)))
        {
            $sql="SELECT count(*) FROM `user` WHERE sex= ? and ? =<age  and age<= ?";
            $a = $this->mysql->prepare($sql);
            $a->execute(array($sex,$agel,$ager));
            $result=$a->fetch();
            return $result[0];
        }
        if(!empty($sex)&& $ager==null && $agel==null)
        {
            $sql="SELECT count(*) FROM `user` WHERE sex= '$sex'";
            $result = $this->mysql->query($sql)->fetch();
            return $result[0];
        }

        if(!empty($name))
        {
            $sql="SELECT count(*) FROM `user` WHERE name= '$name'";
            $result = $this->mysql->query($sql)->fetch();
            return $result[0];
        }
        $sql="SELECT count(*) FROM `user`";
        $result = $this->mysql->query($sql)->fetch();
        return $result[0];


    }

    function findSexUser($sex,$offset,$pagesize){  //

        $sql="SELECT * FROM `user` WHERE  sex= '$sex' LIMIT $offset,$pagesize";
        return $this->mysql->query($sql)->fetchAll(\PDO::FETCH_ASSOC);


    }
    function addUser($name,$sex,$age,$comment){
        $sql="INSERT INTO `user` ( `name`,`sex`, `age`,`comment`) VALUES (?,?,?,?)";
        $a=$this->mysql->prepare($sql);
        if($a->execute(array($name,$sex,$age,$comment,)))
            return 1;
        else
            return 0;
    }
    function delUser($id){
        $sql="DELETE FROM `user` WHERE id= ? ";
        $a=$this->mysql->prepare($sql);
        if($a->execute(array($id)))
            return 1;
        else
            return 0;
    }
    function upUser($id,$name,$sex,$age,$comment){
        $sql="UPDATE `user` SET `name`=?,`sex`=?,`age`=?,`comment`=? WHERE id=?";
        $a=$this->mysql->prepare($sql);
        if($a->execute(array($name,$sex,$age,$comment,$id)))
            return 1;
        else
            return 0;


    }
    function getUserModity($id){
        $dbh=$this->mysql;
        $sql="SELECT * FROM `user` WHERE id=?";
        $qurr=$dbh->prepare($sql);
        $qurr->execute(array($id));
        $row=$qurr->fetch(\PDO::FETCH_ASSOC);
        return $row;


    }
    function findUserall(){
        $sql="SELECT * FROM `user`";
        $qurr=$this->mysql->query($sql);
        $string=array();
        while ($row=$qurr->fetch(\PDO::FETCH_ASSOC))
        {
            $string[]=$row;

        }
        return $string;
    }

    function findUserlimit($offset,$pagesize)
    {
            $sql = "SELECT * FROM `user` LIMIT $offset,$pagesize";
            return $this->mysql->query($sql)->fetchAll(\PDO::FETCH_ASSOC);


    }

    function serchUser($sex,$agel,$ager){

        $dbh=$this->mysql;
        //var_dump($dbh);
        $sql="SELECT * FROM `user` WHERE  sex= ? and ? <=age and age<= ? ";
        $a=$dbh->prepare($sql);
        $a->execute(
            array($sex,$agel,$ager)
        );
        $string=$a->fetchAll(\PDO::FETCH_ASSOC);

        return $string;
    }
}
?>