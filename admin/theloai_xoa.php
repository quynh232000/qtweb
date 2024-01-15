<?php
session_start();
require '../functions.php';
if (checklogin()==false){  echo "Không xóa nhé"; exit(); }
$idTL = $_POST['idTL']??"";
if($idTL!=""){
    $sql= "DELETE FROM theloai WHERE idTL =$idTL";
    execute($sql);
    echo 0;
}
else echo"không được";
?>