<?php
session_start();
require_once "../functions.php";
if (checklogin()==false){  header('Location: login.php'); exit(); }
$page = $_GET['page'] ?? "theloai";
?>
<?php
   $msg="";
   $h2="THÊM MỚI THỂ LOẠI";
   $idTL=$_GET['idTL']??"";
   if($idTL!=""){
      $h2="CHỈNH SỬA THỂ LOẠI";
      $sql="SELECT * FROM theloai WHERE idTL =$idTL";
      $result=executeResult($sql);
   }
   else{}
   if(isset($_POST['submit'])){
      $name=$_POST['name']??"";
      $thutu=$_POST['thutu']??"";
      $anHien=$_POST['anHien']??0;
      $lang=$_POST['lang']??"vi";
      if($name!="" && $thutu!=""){
         if($idTL!=""){
               $sql="UPDATE theloai set TenTL='$name',
                     ThuTu=$thutu, AnHien=$anHien, lang  ='$lang'
                     WHERE idTL =$idTL";
               $kq=execute($sql);
               header('Location: index.php?page=theloai'); 
               die();
         }
         else{
               $sql="INSERT INTO theloai(TenTL,ThuTu,AnHien,lang)
                     VALUES ('$name',$thutu,$anHien,'$lang')";
               $kq=execute($sql); 
               header('Location: index.php?page=theloai'); die();
         }
      }
      else{
         $msg="Vui lòng nhập đầy đủ thông tin";
      }
   }
?>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <link rel="stylesheet" href="./main.css">
   <title>Quản trị web tổng hợp</title>
   <style>
      .error-msg {
         width: 100%;
         text-align: center;
         color: rgb(92, 2, 2);
         background: rgba(218, 77, 77, 0.729);
         border-radius: 5px;
         margin: 5px 0;
         font-weight: 600;
      }
   </style>
</head>
<body>
   <!-- Nav tabs -->
   <div class="container">
   <?php require_once "menu.php";?>
   <!-- Tab panes -->
   <div class="tab-content">
      <div class="tab-pane active" id="">  
      &nbsp;       
      <div class="container col-8 m-auto">
      <h2 class="py-2 text-center h4 "><?= $h2 ?></h2>
      <form action="" method="post">
         <div class="form-line active">
               <label for="">Tên Thể loại</label>
               <input type="text" name="name" value="<?= $result[0]['TenTL']??"" ?>" class="form-control">
         </div>
         <div class="form-line active">
               <label for="">Thứ tự</label>
               <input type="number" name="thutu" value="<?= $result[0]['ThuTu']??"" ?>"  class="form-control">
         </div>
         <div class="form-line">
            <label style="min-width:10px">Ẩn Hiện:</label>
            <input type="radio" name="anHien" value="0" checked> Ẩn
            <input type="radio" name="anHien" value="1"> hiện
            &nbsp; &nbsp;        
            <label style="min-width:10px">Ngôn ngữ:</label>
            <input type="radio" name="lang" value="vi" checked> Việt Nam
            <input type="radio" name="lang" value="en"> English
         </div>
         <button class="btn btn-success px-3" name="submit">Lưu</button>
         <div class="error-msg"><?= $msg ?></div>
      </form>
      </div>
      </div> <!-- tab-pane-->
   </div>
   </div>
</body>
</html>