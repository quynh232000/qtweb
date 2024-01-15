<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
function goimail($to, $to_name, $subject, $noidungthu){ 
    require "PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
    require "PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
    require 'PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
      try {
          $mail->SMTPDebug = 2;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0 nhé
          $mail->isSMTP();  
          $mail->CharSet  = "utf-8";
          $mail->Host = 'smtp.gmail.com';  //SMTP servers
          $mail->SMTPAuth = true; // Enable authentication
          $nguoigui = 'emailCủaBạn@gmail.com';
          $matkhau = 'mật khẩu';
          $tennguoigui = 'Nhập tên người gửi';
          $mail->Username = $nguoigui; // SMTP username
          $mail->Password = $matkhau;   // SMTP password
          $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
          $mail->Port = 465;  // port to connect to                
          $mail->setFrom($nguoigui, $tennguoigui );
          
          $mail->addAddress($to, $to_name); //mail và tên người nhận  
          $mail->isHTML(true);  // Set email format to HTML
          $mail->Subject = $subject;              
          $mail->Body = $noidungthu;
          $mail->smtpConnect( array(
              "ssl" => array(
                  "verify_peer" => false,
                  "verify_peer_name" => false,
                  "allow_self_signed" => true
              )
          ));
          $mail->send();
          echo 'Đã gửi mail xong';
      } catch (Exception $e) {
          echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
      }
}
if (isset($_POST['guilienhe'])==true){
    $hoten = trim(strip_tags($_POST['hoten']));
    $email = trim(strip_tags($_POST['email']));
    $noidung = trim(strip_tags($_POST['noidung']));    
    $to = 'emailCủa@QWuảnTriWebsite';
    $to_name="Họ tên người quản trị";
    $subject ='Thư liên hệ từ khách hàng';
    $noidungthu = "<p>
        Họ tên khách hàng: $hoten<br>
        Email khách hàng: $email<br>
        Nội dung liên hệ : <br>
        $noidung
    </p>";
    goimail($to, $to_name, $subject, $noidungthu);
}
?>
<form method="post" class="col-8 m-auto">
    <h4>LIÊN HỆ QUẢN TRỊ</h4>
    <p class="mb-3">
        <span>Họ tên của bạn</span>
        <input class="form-control" name="hoten">
    </p>
    <p class="mb-3">
        <span>Email của bạn</span>
        <input class="form-control" name="email">
    </p>
    <p class="mb-3">        
        <textarea class="form-control" name="noidung" rows="5"></textarea>
    </p>
    <p class="mb-3">
        <button type="submit" name="guilienhe" class="btn btn-success">Gửi liên hệ</button>
    </p>
</form>
