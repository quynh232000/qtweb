<?php
   session_start();
   require_once "config.php";
   require_once './site_info.php';
   require_once "./functions.php";  
   $page =$_GET['page']??"home";
?>
<html>
<head>
    <title><?=getTitle($page, $defaultTile = $site_info['tenWebsite']);?></title>
    <base href="<?=BASE_DIR?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $descriptionPage = getDescription($page)?>
    <?php if ($descriptionPage!="") { ?>
    <meta name="description" content="<?=$descriptionPage?>">
    <?php } ?>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>

</head>
<body>
    <div class="container">
    <header><?php require_once "header.php"; ?></header>
    <?php if ($page=="" || $page=="home") { ?>
    <section class="tinnoibat mb-1"><?php require_once "tinnoibat.php";?></section>
    <?php } ?>
    <section class="main row">        
        <article class="col-md-9">
        <?php 
        $arrPage = ['home','tinchitiet', 'tintrongloai','timkiem'];
        if (in_array($page, $arrPage)==true) 
            require_once "./$page.php";
            else "Không tồn tại [page";
        ?>
        </article>
        <aside class="col-md-3">
        <div class="advertisement">
            <div class="title">STAY CONNECTED</div>
            <div class="content">
                <div class="linkContact" style="margin-bottom: 10px;">
                    <div class="footer-social">
                        <a href="" class="socail-f">
                            <i class='bx bxl-facebook'></i>
                        </a>
                        <a href="" class="socail-ins">
                            <i class='bx bxl-instagram'></i>
                        </a>
                        <a href="" class="socail-tw">
                            <i class='bx bxl-twitter'></i>
                        </a>
                        <a href="" class="socail-yb">
                            <i class='bx bxl-youtube'></i>
                        </a>
                        <a href="" class="socail-g">
                            <i class='bx bxl-google-plus'></i>
                        </a>
                        <a href="" class="socail-g">
                            <i class='bx bxl-google-plus'></i>
                        </a>
                    </div>
                </div>
                <div class="postAdv">
                    <div class="title">QUẢNG CÁO </div>
                    <img src="https://images.unsplash.com/photo-1636321026976-b2b85c627a7e?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw1Nnx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                </div>
            </div>
        </div>
        </aside>
    </main>
    <footer><?php require_once "./footer.php" ?></footer>
</body>
</html>