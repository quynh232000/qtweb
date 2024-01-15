<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Đăng ký thành viên</title>
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
     <div class="container form col-6 m-auto border border-primary p-2" style="transform:scale(0.9); background:#fff ; border-radius:8px" >
         <h2>ĐĂNG KÝ THÀNH VIÊN</h2>
         <form action="" id="sign" class="">
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
                 <input type="radio" name="gt" value="0"> <span style="margin-left:5px"> Nam</span>
                 <input type="radio" name="gt" value="1" > <span style="margin-left:5px">  Nữ</span>
                 &nbsp; &nbsp;
                 <span>Sở thích</span>
                 <input type="checkbox" name="hobby" value="Đấ bóng" > <span style="margin-left:5px"> Đá Bóng </span>
                 <input type="checkbox" name="hobby" value="bơi lội" >  <span style="margin-left:5px"> Bơi Lội</span>
                 <input type="checkbox" name="hobby" value="đọc sách" > <span style="margin-left:5px"> Đọc Sách </span>
             </div>
             <div class="mb-3">
                 <label>Hình ảnh</label>
                 <input class="form-control" type="file" name="file_image" id="">
             </div>
             <div class="mb-3">
                 <label for="">Nghề nghiệp</label>
                 <input class="form-control" type="text" name="job" id="" placeholder="bạn đang làm nghề gì ?">
             </div>
             <div class="mb-3">
                 <label for="">Giới Thiệu</label>
                 <textarea class="form-control" name="intro" id="" cols="" rows=""></textarea>
             </div>
             <button class="btn btn-success signBtn">Đăng kí</button>
             <button class="btn btn-warning">Làm lại</button>
         </form>
         <div class="error-msg"></div>
         <a href="<?=BASE_DIR?>formLogin.php">i have a count</a>
     </div>
</body>>
</html>