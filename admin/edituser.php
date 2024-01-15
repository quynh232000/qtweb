<?php
 function uploadFile($file)
{
    // print_r($file);
    $fileDir = "./upload/images";
    if (isset($file) && $file['error'] == 0) {
        $fileName = basename($file['name']);
        if (!file_exists($fileDir)) {
            mkdir($fileDir, 0, true);
        }
       
        $fileDir =$fileDir .'/'.$fileName;
        if (move_uploaded_file($file['tmp_name'], $fileDir)) {
            return $fileName;
            
        }else{
            return false;
        }
    } else {
        return false;
    }
}
if(isset($_GET['id']) && $_GET['id']){
    $id =$_GET['id'];
    $sql="SELECT * From users where user_id = '$id'";
    $db_Host = DB_HOST; 
    $db_User= DB_USERNAME;
    $db_Pass= DB_PASSWORD; 
    $db_Name = DB_NAME;
    $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch();
   
}



if (isset($_POST['username']) && $_POST['username']) {
    $file='';
    extract($_POST);
    $id = $user_id;
    if(isset($_FILES['file_image'])){

        $fileLink =uploadFile($_FILES['file_image']);
        if($fileLink !=false){
            $file = "file_img= '$fileLink' ,";
        }
    }
    
    // file_img= ,
    $sql="UPDATE users SET
    user_name='$username',
    email= '$email',
    password= '$password',
    gt= '$gt',
    $file
    hobby= '$hobby',
    nghe_nghiep= '$nghe_nghiep',
    intro= '$intro',
    group_id= '$group_id'
    WHERE user_id = '$id' ";
    $db_Host = DB_HOST; 
    $db_User= DB_USERNAME;
    $db_Pass= DB_PASSWORD; 
    $db_Name = DB_NAME;
    $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec($sql);
    header('location: ?page=user');
}



?> 

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="container form col-6 m-auto border border-primary p-4"
    style="transform:scale(0.9); background:#fff ; border-radius:8px">

    <h2 class="text-center p-2 mb-4">CHỈNH SỬA THÔNG TIN USER</h2>
    <form action="" method="post" id="sign" class="" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Tên Đăng Nhập</label>

            <input class="form-control"  value="<?=$user['user_name'] ?>" type="text" name="username">
            <input class="form-control" readonly value="<?=$user['user_id'] ?>" hidden type="text" name="user_id">
        </div>
        <div class="mb-3">
            <label for="">Mật Khẩu</label>
            <input class="form-control" value="<?=$user['password'] ?>" type="password" name="password">
        </div>
        
        <div class="mb-3">
            <label for="">Email</label>
            <input class="form-control" type="text" value="<?=$user['email'] ?>" name="email" id="">
        </div>
        <div class="mb-3">
            <span>Giới tính</span>
            <div class="d-flex " style="gap:40px">
                <div class="d-flex">
                    <input type="radio" name="gt" value="0" <?=$user['gt'] ==0 ?"checked":"" ?>> <span style="margin-left:5px"> Nam</span>
                </div>
                <div class="d-flex">
                    <input type="radio" name="gt" value="1" <?=$user['gt'] ==1 ?"checked":"" ?>> <span style="margin-left:5px"> Nữ</span>
                </div>
            </div>
            &nbsp; &nbsp;
            <span>Sở thích</span>
            <div style="display:flex;justify-content:space-around;gap:10px">
                <div class="d-flex">
                    <input type="radio" name="hobby" checked  value="Đấ bóng" <?=$user['hobby'] =="Đấ bóng" ?"checked":"" ?>> <span style="margin-left:5px"> Đá Bóng </span>
                </div>
                <div class="d-flex">
                    <input type="radio" name="hobby" value="bơi lội" <?=$user['hobby'] =="bơi lội" ?"checked":"" ?>  > <span style="margin-left:5px">
                        Bơi Lội</span></div>
                <div class="d-flex">
                    <input type="radio" name="hobby" value="đọc sách" <?=$user['hobby'] =="đọc sách" ?"checked":"" ?>  > <span style="margin-left:5px"> Đọc Sách </span>
                </div>
            </div>
        </div>
        <div class="mb-3 d-flex" style="flex-direction:column">
            <label>Hình ảnh</label>
            <img class="m-4" width="42px" height="42px" style="border-radius:50%;object-fit:cover;border:1px solid gray;margin:auto" src="../upload/images/<?=$user['file_img'] ?>" alt="">
            <input class="form-control" type="file" name="file_image" id="">
        </div>
        <div class="mb-3">
            <label for="">Nghề nghiệp</label>
            <input class="form-control" type="text" value="<?=$user['nghe_nghiep'] ?>" name="nghe_nghiep" id="" placeholder="bạn đang làm nghề gì ?">
        </div>
        <div class="mb-3">
            <label for="">Quyền</label>
            <input class="form-control" type="text" name="group_id" value="<?=$user['group_id'] ?>" id="" placeholder="bạn đang làm nghề gì ?">
        </div>
        <div class="mb-3">
            <label for="">Giới Thiệu</label>
            <input class="form-control" name="intro" value="<?=$user['intro'] ?>" id="" cols="" rows="">
        </div>
        <button class="btn btn-success signBtn"type="submit" > Lưu</button>
    </form>
    <div class="error-msg"></div>
    <a href="<?= BASE_DIR ?>formLogin.php">i have a count</a>
</div>