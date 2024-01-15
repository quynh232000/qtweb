<?php
session_start();
require_once "../functions.php";
$msg="";
if(isset($_POST['submit'])){
    $un = trim(strip_tags($_POST['un']))??"";
    $pw = trim(strip_tags($_POST['pw']))??"";
    if ($un!="" && $pw!="" ) {
        $sql="SELECT * FROM users WHERE user_name=? AND password=? AND group_id=1";
        $db_Host = DB_HOST; 
        $db_User= DB_USERNAME;
        $db_Pass= DB_PASSWORD; 
        $db_Name = DB_NAME;
        $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
        $st = $conn->prepare($sql);
        $st->execute( [$un, $pw] );
        $data = $st->fetchAll(PDO::FETCH_ASSOC);       
        if ($data !=null && count($data)==1){ //thành công
            $_SESSION['un']=$un;
            header('Location: index.php'); exit();  
        }
        else {
            header('Location: login.php'); exit();
        }
     }
     else{ 
         $msg="<span class='p-3'>Vui lòng nhập đầy đủ thông tin</span>";
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
  
    <title>Đăng nhập Admin</title>
    <style>
    .error-msg{
            width: 100%;
            text-align: center;
            color: rgb(92, 2, 2);
            background:rgba(218, 77, 77, 0.729);
            border-radius: 5px;
            
            margin: 5px 0;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container col-6 m-auto mt-5" style="transform: rotate(-5deg);">
        <h4 class="p-2 text-center bg-success text-white">ĐĂNG NHẬP QUẢN TRỊ WEBSITE</h4>
        <form class="border border-success" action="" method="post" id="login">
            <div class="m-3">
                <label>Tên đăng nhập</label>
                <input autofocus  class="form-control" type="text" name="un" placeholder="Nhập tài khoản của bạn">
            </div>
            <div class="m-3" >
                <label>Mật Khẩu</label>
                <input class="form-control" type="password" name="pw" placeholder="Nhập mật khẩu">
            </div>
            <div class="m-3" >
                <span>Nhớ Mật Khẩu</span>
                <input type="checkbox" name="remember">
            </div>
            <button type="submit" name='submit' class="mx-3 mb-3 btn btn-primary w-25 submit">Đăng nhập</button>
         
        </form>
        <div class="error-msg"><?=$msg?></div>
        
    </div>

    
</body>
</html>