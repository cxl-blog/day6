
<?php
/**
 * Created by PhpStorm.
 * User: kuozhi
 * Date: 17-7-11
 * Time: 下午5:57
 */

/*namespace User;*/
use User\usercontroller\Usercontroller;
require_once __DIR__."/vendor/autoload.php";
error_reporting(E_ALL || ~E_NOTICE);
header("Content-type: text/html; charset=utf-8");
if(isset($_GET['action']))
    $method=$_GET['action']."Action";
if(isset($_POST['action']))
    $method=$_POST['action']."Action";
$controller=new Usercontroller();
$controller->$method();
?>
