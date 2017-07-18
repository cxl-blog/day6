<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-11
 * Time: 下午5:23
 */
namespace  User\usercontroller;
//use User\Config\Usermodel;
use User\Userserver\Userserver;
require_once "vendor/autoload.php";
class Usercontroller{

    public static $users=null;

    function getmodel(){
        $user=new Userserver();
        //var_dump($user);
        return $user;
    }

    function addAction()
    {
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $age=$_POST['age'];
        $comment=$_POST['comment'];
        if($this->getmodel()->addUser($name,$sex,$age,$comment))
        {
            echo "ok";
            //header("Refresh:3; url=?controller=User&action=list");
        }
        else{
            echo "false";
            //header("Refresh:3; url=?controller=User&action=list");
        }
    }

    function delAction()
    {
        $id=$_GET['id'];
        if($this->getmodel()->delUser($id)) {
            echo "ok";
        }
        else
        {
            echo "false";
        }
    }

    function modifyAction(){
        $id=$_GET['id'];
        $user=$this->getmodel()->getUserModity($id);
        //print_r($user);
        echo json_encode($user, JSON_UNESCAPED_UNICODE);
        //$this->render("/edit-view.twig",array('user'=>$user));
    }

    function testAction(){
        echo "ok";
    }

    function upAction(){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $sex=$_POST['sex'];
        $age=$_POST['age'];
        $comment=$_POST['comment'];
        //echo json_encode($user, JSON_UNESCAPED_UNICODE);
        if($this->getmodel()->upUser($id,$name,$sex,$age,$comment)) {
            echo "ok";
        }
        else
        {
            echo "false";
        }
    }

    function sleAction(){
        $data=urldecode(trim($_GET['seledata']));
        if(!isset($_POST['delrequest']))
        {
            $array=$this->getmodel()->paging("","","",$data);
            $this->render("/sele-view.twig",$array);
        }
        else
            {
                $array=$this->getmodel()->paging("","","",$data);
                echo json_encode($array, JSON_UNESCAPED_UNICODE);
            }


    }

    function serchuserAction()
    {
        $sex = urldecode($_GET['sex']);
        $agel =$_GET['agel'];
        $ager =$_GET['ager'];
        if(!isset($_POST['delrequest']))
        {
            $array=$this->getmodel()->paging($sex,$agel,$ager,'');
            $this->render("/serchuser-view.twig",$array);
        }
        else
        {
            $array=$this->getmodel()->paging($sex,$agel,$ager,'');
            echo json_encode($array, JSON_UNESCAPED_UNICODE);
        }
    }

    function listAction(){//twig分页
        $array=$this->getmodel() -> paging("","","","");
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    private function render($renderTwig,$data = array())
    {
    $loader = new \Twig_Loader_Filesystem('view');
    $twig = new \Twig_Environment($loader);
    echo $twig->render($renderTwig,$data);

}
}
?>