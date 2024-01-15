<?php
session_start();
require '../functions.php';
if (checklogin()==false){  echo "Không xóa nhé"; exit(); }
$idLT=$_POST['idLT']??"";
if($idLT!=""){
    $sql= "DELETE FROM loaitin WHERE idLT =$idLT";
    execute($sql);
    echo 0;
}
else echo $idLT;
?>