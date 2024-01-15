<?php
require_once "../functions.php";
if (checklogin()==false){  echo "Không vào được nhé"; exit(); }
$page = "thongtin";
$msg="";
$filename = "../site_info.php";
require_once $filename;
$email = $site_info['email'];
$phone = $site_info['phone'];
$diachi = $site_info['diachi'];
$gioithieu = $site_info['gioithieu'];
$tenAdmin = $site_info['tenAdmin'];
$tenWebsite = $site_info['tenWebsite'];
if(isset($_POST['submit'])){
   $email = $_POST['email']??"";
   $phone = $_POST['phone']??"";
   $diachi = $_POST['diachi']??"";
   $gioithieu = $_POST['gioithieu']??"";   
   $tenAdmin = $_POST['tenAdmin']??"";
   $tenWebsite = $_POST['tenWebsite']??"";
   if ($email!="" && $phone!="" && $diachi!='' ) {    
      $data ="<?php
      \$site_info = [
         'email' => '$email',
         'phone' => '$phone',
         'diachi'=>'$diachi',
         'tenAdmin' => '$tenAdmin',
         'tenWebsite'=>'$tenWebsite',
         'gioithieu'=>'$gioithieu'
      ]
      ?>
      ";
      file_put_contents($filename, $data);
      header('Location: index.php?page=theloai'); exit();
   }
   else{ $msg="<span class='p-3'>Vui lòng nhập đầy đủ thông tin</span>";}
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
   <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
   <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/translations/vi.js"> </script>
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
      <div class="col-8 m-auto" >
         <h2 class="py-2 text-center h4 ">THÔNG TIN WEBSITE</h2>
         <form action="" method="post">
            <div class="mb-3 row">
                  <label class="col-3">Email</label>
                  <input class=" col-9 form-control" type="email" name="email" value="<?= $email??"" ?>">
            </div>
            <div class="mb-3 row">
                  <label class="col-3">Điện thoại</label>
                  <input class=" col-9 form-control" type="text" name="phone" value="<?= $phone??"" ?>">
            </div>
            <div class="mb-3 row">
                  <label class="col-3">Địa chỉ</label>
                  <input class=" col-9 form-control" type="text" name="diachi" value="<?= $diachi??"" ?>">
            </div>
            <div class="mb-3 row">
                  <label class="col-3">Tên Admin</label>
                  <input class=" col-9 form-control" type="text" name="tenAdmin" value="<?= $tenAdmin??"" ?>">
            </div>
            <div class="mb-3 row">
                  <label class="col-3">Tên Website </label>
                  <input class=" col-9 form-control" type="text" name="tenWebsite" value="<?= $tenWebsite??"" ?>">
            </div>
            <div class="mb-3 row">
                  <label class="col-3">Giới thiệu Website </label>
                  <textarea class="col-9 form-control" rows="5" name="gioithieu"><?= $gioithieu??""?></textarea>
            </div>
            <div class="mb-3 row">                  
                  <label class="col-3"> </label>
                  <button class="col-3 btn btn-primary"  style="height:45px" type="submit" name="submit">Lưu thông tin </button>
            </div>   
            
            <div class="row error-msg text-white"><?= $msg??"" ?> </div>
         </form>
      </div>
      </div>
   </div>
   </div>
</body>

</html>

<script>
ClassicEditor
    .create( document.querySelector( '#gioithieu' ), {language: 'vi'} )
    .then( editor => {
        //editor.setData( '<p>Nội dung của tin</p>' );
    } )
    .catch( error => {
        console.error( error );
    } );    
</script>
<style>
.ck-editor__editable_inline {
    min-height: 250px;
    max-height: 450px;
}
</style>