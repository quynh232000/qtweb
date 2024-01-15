<?php
session_start();
require_once "../functions.php";
if (checklogin()==false){  header('Location: login.php'); exit(); }
$page = $_GET['page'] ?? "theloai";
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
      <?php
      // lấy ra danh mục thể loại hiên thị trong select
      $sql="SELECT * FROM theloai";
      $listTL=executeResult($sql);
      $msg="";
      $h2="THÊM MỚI LOẠI TIN ";
      $idLT=$_GET['idLT']??"";
      if($idLT!=""){
         $h2="CHỈNH SỬA LOẠI TIN";
         $sql="SELECT * FROM loaitin WHERE idLT =$idLT";
         $result=executeResult($sql);
      }      
      if(isset($_POST['submit'])){
         $name=$_POST['name']??"";
         $thutu=$_POST['thutu']??"";
         $anHien=$_POST['anHien']??0;
         $lang=$_POST['lang']??"vi";
         $idTL=$_POST['TL'];
         $MoTa=$_POST['MoTa'];
         if($name!="" && $thutu!=""){
            if($idLT!=""){
                  $sql="UPDATE loaitin set Ten='$name',
                     ThuTu=$thutu, AnHien=$anHien, lang  ='$lang', idTL =$idTL,
                     MoTa='$MoTa'
                     WHERE idLT =$idLT";
                  $kq=execute($sql);
                  header('Location: index.php?page=loaitin'); 
                  exit();
            }
            else{
                  $sql="INSERT INTO loaitin(Ten,ThuTu,AnHien,lang,idTL,MoTa)
                  VALUES ('$name',$thutu,$anHien,'$lang',$idTL,'$MoTa')";
                  $kq=execute($sql); 
                  header('Location: index.php?page=loaitin'); die();
            }
         }
         else $msg="Vui lòng nhập đầy đủ thông tin";         
      }
      ?>
      <div class="container col-8 m-auto">
      <h2 class="py-2 text-center h4 "><?= $h2 ?></h2>
      <form action="" method="post">
         <div class="mb-3">
               <label for="">Tên loại tin</label>
               <input type="text" name="name" value="<?= $result[0]['Ten']??"" ?>" class="form-control bg-light" >
         </div>
         <div class="mb-3">
               <label for="">Thứ tự</label>
               <input type="number" name="thutu" value="<?= $result[0]['ThuTu']??"" ?>" class="form-control bg-light" >
         </div>
         <div class="mb-3">
            <label style="min-width:10px">Ẩn Hiện:</label>
            <?php if (isset( $result)==true) { ?>
               <input type="radio" name="anHien" value="0" <?= $result[0]['AnHien']==0?"checked":"" ?> > Ẩn
               <input type="radio" name="anHien" value="1" <?=$result[0]['AnHien']==1?"checked":"" ?>> Hiện
            <?php } else { ?>
               <input type="radio" name="anHien" value="0" checked> Ẩn
               <input type="radio" name="anHien" value="1"> Hiện
            <?php } ?>
            &nbsp; &nbsp; 
            <label style="min-width:10px">Ngôn ngữ:</label>
            <?php if (isset( $result)==true) { ?>
               <input type="radio" name="lang" value="vi" <?= $result[0]['lang']=='vi'?"checked":"" ?> > Tiếng Việt
               <input type="radio" name="lang" value="en" <?=$result[0]['lang']=='en'?"checked":"" ?>> English
            <?php } else { ?>
               <input type="radio" name="lang" value="vi" checked> Tiếng Việt
               <input type="radio" name="lang" value="en"> English
            <?php } ?>
         </div>
         <div class="mb-3">
            <label style="min-width:10px">Trong thể loại:</label>
            <select name="TL" id="" class="form-control bg-light" >
               <option value="0">--Chọn thể loại--</option>
               <?php
                  foreach ($listTL as $item) {
                     if ($item['idTL'] == $result[0]['idTL'])
                     echo "<option value='$item[idTL]' selected >$item[TenTL]</option>";
                     else
                     echo "<option value='$item[idTL]'>$item[TenTL]</option>";
                  }
               ?>
            </select>
         </div>
         <div class="mb-3">
               <label for="">Mô tả</label>
               <textarea  name="MoTa" class="form-control bg-light" rows="5"><?= $result[0]['MoTa']??"" ?></textarea>
         </div>
         <button class="btn btn-success px-4" name="submit">Lưu</button>
         <div class="error-msg"><?= $msg ?></div>
      </form>
      </div>
      </div> <!-- tab-pane -->
   </div>
   </div>
</body>
</html>