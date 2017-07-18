<?php

/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-13
 * Time: 上午10:48
 */
namespace User\Userserver;
use User\Dao\UserDao;

class Userserver
{
    function getUserDao(){
        $getDao=new UserDao();
        return $getDao;

    }

    function getUser($id){
        $this->getUserDao()->getUser($id);
    }
    function findUserByname($name,$offset,$pagesize){
        return $this->getUserDao()->findUserByname($name,$offset,$pagesize);
    }

    function findUserall($select,$offset,$pagesize)
    {
        if($select=='')
            return $this->getUserDao()->findUserlimit($offset,$pagesize);
        else
            return $this->getUserDao()->findSexUser($select,$offset,$pagesize);
    }

    function getUserModity($id)
    {
        return $this->getUserDao()->getUserModity($id);
    }

    function delUser($id)
    {
        return $this->getUserDao()->delUser($id);

    }

    function addUser($name,$sex,$age,$comment)
    {
        return $this->getUserDao()->addUser($name,$sex,$age,$comment);
    }

    function upUser($id,$name,$sex,$age,$comment)
    {
        return $this->getUserDao()->upUser($id,$name,$sex,$age,$comment);
    }

    function seleUser($data,$offset,$pagesize)
    {//id name 查询
        $rule="[0-9]";
        if(preg_match($rule,$data))
        {
            return $this -> getUserDao() -> getUser($data);
        }
        else
            return $this -> getUserDao() -> findUserByname($data,$offset,$pagesize);
    }

    function serchUser($sex,$agel,$ager)
    {
           return $this->getUserDao()->serchUser($sex,$agel,$ager);
    }

    function paging($sex,$agel,$ager,$seledata)
    {

        $page_show = 5;
        $page = 1;
        if (!isset($_GET['page']))
             $page = 1;
        if (isset($_GET['page']))
            $page = $_GET['page'];
        if ($page <= 1)
            $page = 1;
        $offset = ($page - 1) * $page_show;
        if($_GET['action']=='list')
        {
            if(!isset($_GET['select']))
            {
                $num = $this->getUserDao()->getCount('',"","","");
                $users = $this->getUserDao()->findUserlimit($offset, $page_show);
            }
            if(isset($_GET['select']))
            {
                if($_GET['select']=='')
                    $num = $this->getUserDao()->getCount('','','','');
                else
                    $num =$this->getUserDao()->getCount('',urldecode($_GET['select']),'','');

                $users=$this->findUserall(urldecode($_GET['select']),$offset,$page_show);
            }
        }
        if($_GET['action']=='serchuser')
        {
            $num = $this->getUserDao()->getCount('',$sex,$agel,$ager);
            $users=$this->getUserDao()->serchUser($sex, $agel, $ager);
        }
        if($_GET['action']=="sle")
        {
            $rule="/^[0-9]+$/";
            if(preg_match($rule,$seledata))
            {
                $num=0;
                $users = $this -> getUserDao() -> getUser($seledata);
            }
            else
            {
                $num = $this->getUserDao()->getCount($seledata,'','','');
                $users=$this->getUserDao()->findUserByname($seledata,$offset,$page_show);
            }
        }

        $pagenum = ceil($num / $page_show);//分多少页
        $pagelast = $page - 1;
        $pagenext = $page + 1;
        if ($num <= $page_show)
            return array('users' => $users);
        if ($num > $page_show) {
            if ($pagelast > 0 && $pagenext <= $pagenum)
                return array(
                    'users' => $users,
                    'page' => $page,
                    'pagenum' => $pagenum,
                    'num' => $num,
                    'pagelast' => $pagelast,
                    'pagenext' => $pagenext);
            if ($pagelast <= 0)
                return array(
                    'users' => $users,
                    'page' => $page,
                    'pagenum' => $pagenum,
                    'num' => $num,
                    'pagenext' => $pagenext);
            if ($pagenext > $pagenum)
                return array(
                    'users' => $users,
                    'page' => $page,
                    'pagenum' => $pagenum,
                    'num' => $num,
                    'pagelast' => $pagelast);
        }
    }

    function listNum()
    {

    }
}