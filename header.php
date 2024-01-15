<?php
require_once "./functions.php";
$idLT = $_GET['idLT'] ?? "";
$sql = "SELECT * FROM loaitin WHERE AnHien=1 ORDER By ThuTu ASC";
$result = executeResult($sql);
?>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
           <i class='bx bxs-phone'></i> <?=$site_info['phone']?> &nbsp; 
           <i class='bx bx-mail-send'></i>  <?=$site_info['email']?>
        </li>
        </li>
      </ul>
      <div class="d-flex" role="search">
         <?php if (isset($_SESSION['un'])==false) { ?>
                <a class='btn btn-success py-1 px-3' href="<?=BASE_DIR."dang-ky/"?>">Đăng ký</a> &nbsp; 
                <a class="btn btn-primary ml-3 py-1 px-3" href="admin/">Vào quản trị</a>
            <?php } else { ?>                    
                   <a class='btn btn-success py-1 px-3' href="#">Chào <?=$_SESSION['un']?></a>  &nbsp; 
                   <a class="btn btn-primary ml-3 py-1 px-3" href="admin/thoat.php">Thoát</a>
            <?php } ?>
           
      </div>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=BASE_DIR?>"><img src="<?=BASE_DIR?>images/logo.svg" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=BASE_DIR?>">Trang chủ</a>
        </li>
        <?php foreach ($result as $item) {?>
                <?php if ($idLT == $item['idLT']) { ?>
                    <li class="nav-item active">
                    <a class="nav-link" href="<?=BASE_DIR."loai/".$item["slug"]?>/"> <?=$item["Ten"];?></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?=BASE_DIR."loai/".$item["slug"]?>/"> <?=$item["Ten"];?></a>
                    </li>
                <?php } ?>
            <?php } ?>
        <li class="nav-item active">
           <a class="nav-link" href="<?=BASE_DIR."lien-he/"?>">Liên hệ</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tài khoản
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Đăng ký</a></li>
            <li><a class="dropdown-item" href="#">Đăng nhập</a></li>
          </ul>
        </li>        
      </ul>
    </div>
  </div>
</nav>

<div class="header-slogan p-n1">
    <div class="container">
        <div class="svg">Top News</div>
        <div class="text">Cập nhật những tin túc mới nhất từ VTV</div>
    </div>
</div>


