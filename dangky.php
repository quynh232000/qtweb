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



if (isset($_POST['username']) && $_POST['username']) {

    extract($_POST);

    $file =uploadFile($_FILES['file_image']);
    

    $sql="INSERT INTO users (user_name,email,password,gt,file_img,hobby,nghe_nghiep,intro,group_id) values
    ('$username','$email','$password','$gt','$file','$hobby','$nghe_nghiep','$intro','0')";
    $db_Host = DB_HOST; 
    $db_User= DB_USERNAME;
    $db_Pass= DB_PASSWORD; 
    $db_Name = DB_NAME;
    $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec($sql);
}



?> 

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="container form col-6 m-auto border border-primary p-4"
    style="transform:scale(0.9); background:#fff ; border-radius:8px">

    <h2>ĐĂNG KÝ THÀNH VIÊN</h2>
    <form action="" method="post" id="sign" class="" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Tên Đăng Nhập</label>
            <input class="form-control" type="text" name="username">
        </div>
        <div class="mb-3">
            <label for="">Mật Khẩu</label>
            <input class="form-control" type="password" name="password">
        </div>
        <div class="mb-3">
            <label for="">Nhập lại mật khẩu</label>
            <input class="form-control" type="text" name="confirmP" id="">
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input class="form-control" type="text" name="email" id="">
        </div>
        <div class="mb-3">
            <span>Giới tính</span>
            <div class="d-flex " style="gap:40px">
                <div class="d-flex">
                    <input type="radio" name="gt" value="0"> <span style="margin-left:5px"> Nam</span>
                </div>
                <div class="d-flex">
                    <input type="radio" name="gt" value="1"> <span style="margin-left:5px"> Nữ</span>
                </div>
            </div>
            &nbsp; &nbsp;
            <span>Sở thích</span>
            <div style="display:flex;justify-content:space-around;gap:10px">
                <div class="d-flex">
                    <input type="radio" name="hobby" value="Đấ bóng"> <span style="margin-left:5px"> Đá Bóng </span>
                </div>
                <div class="d-flex"><input type="radio" name="hobby" value="bơi lội"> <span style="margin-left:5px">
                        Bơi Lội</span></div>
                <div class="d-flex">
                    <input type="radio" name="hobby" value="đọc sách"> <span style="margin-left:5px"> Đọc Sách </span>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label>Hình ảnh</label>
            <input class="form-control" type="file" name="file_image" id="">
        </div>
        <div class="mb-3">
            <label for="">Nghề nghiệp</label>
            <input class="form-control" type="text" name="nghe_nghiep" id="" placeholder="bạn đang làm nghề gì ?">
        </div>
        
        <div class="mb-3">
            <label for="">Giới Thiệu</label>
            <textarea class="form-control" name="intro" id="" cols="" rows=""></textarea>
        </div>
        <button class="btn btn-success signBtn"type="submit" >Đăng kí</button>
        <button class="btn btn-warning" type="reset">Làm lại</button>
    </form>
    <div class="error-msg"></div>
    <a href="<?= BASE_DIR ?>formLogin.php">i have a count</a>
</div>