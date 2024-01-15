<?php
session_start();
require '../functions.php';
if (checklogin()==false){  echo "Không xóa nhé"; exit(); }
$user_id=$_POST['user_id']??"";
if($user_id!=""){
    $sql= "DELETE FROM users WHERE user_id =$user_id";
    execute($sql);
    echo 0;
}
else echo"không được";
?>