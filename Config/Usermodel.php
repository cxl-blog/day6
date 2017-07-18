<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-13
 * Time: 上午9:54
 */
namespace User\model;
use User\model\Sql;
class Usermodel{
    function mysql(){
        $dbh=new Sql();
        return $dbh->ConnectUser();
    }
    public  function getSelect($name)
    {
        //var_dump($name);
        $dbh=$this->mysql();
        //var_dump($dbh);
        $sql="SELECT * FROM `user` WHERE  name= ? ";
        $a=$dbh->prepare($sql);
        $a->execute(
            array($name)
        );
        $string=$a->fetchAll();
        /*$qurr=$dbh->query($sql);
        $string=array();
        while ($row=$qurr->fetch(\PDO::FETCH_ASSOC))
        {
            $string[]=$row;
        }*/

        return $string;


    }
    function getUser($id){//id查询
        $dbh=$this->mysql();
        $sql="SELECT * FROM `user` WHERE  `name`='$id'";
        $qurr=$dbh->query($sql);
        $string=array();
        while ($row=$qurr->fetch(\PDO::FETCH_ASSOC))
        {
            $string[]=$row;
        }

        return $string;

    }
    function getAdd($name,$sex,$age,$comment){
        $dbh=$this->mysql();
        $sql="INSERT INTO `user` ( `name`,`sex`, `age`,`comment`) VALUES ('$name','$sex','$age','$comment')";
        if($dbh->query($sql))
            return 1;
        else
            return 0;



    }
    function getDel($id){
        $dbh=$this->mysql();
        $sql="DELETE FROM `user` WHERE id=$id";
        if($dbh->query($sql))
            return 1;
        else
            return 0;

    }
    function getUp($id,$name,$sex,$age,$comment){
        $dbh=$this->mysql();
        $sql="UPDATE `user` SET `name`='$name',`sex`='$sex',`age`='$age',`comment`='$comment' WHERE id='$id'";
        if($dbh->query($sql))
            return 1;
        else
            return 0;


    }
    function getModity($id){
        $dbh=$this->mysql();
        $sql="SELECT * FROM `user` WHERE id=$id";
        $qurr=$dbh->query($sql);
        $row=$qurr->fetch(\PDO::FETCH_ASSOC);
        return $row;


    }
    function getList(){
        $sql="SELECT * FROM `user`";
        $dbh=$this->mysql();
        $qurr=$dbh->query($sql);
        $string=array();
        while ($row=$qurr->fetch(\PDO::FETCH_ASSOC))
        {
            $string[]=$row;

        }
        return $string;



    }
}
?>