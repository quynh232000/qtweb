<?php
session_start();
require '../functions.php';
if (checklogin()==false){  header('Location: login.php'); exit(); }
if (checklogin()==false){  echo "Không xóa nhé"; exit(); }
$idTin=$_POST['idTin']??0;
if($idTin>0){
    $sql= "DELETE FROM tin WHERE idTin =$idTin";
    execute($sql);
    echo 0;
}
else echo $idTin;
?>