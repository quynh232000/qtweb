<?php
require_once "./functions.php";
$slug = $_GET['slug']??'';
$idLT = layidLT($slug);

if($idLT==""){
    header('Location : /index.php' );
    exit();
}

$limit=PAGE_SIZE;
$sql ="SELECT count(idTin) as num FROM tin WHERE idLT=$idLT AND AnHien=1 ";
$numPost = executeResult($sql)[0]['num'];

$numPage=ceil($numPost/$limit);// SỐ CHỈ MỤC PANIGATION         
$currentPage=$_GET['currentPage']??1;   // lấy ra trang hiện tại
$index= ($currentPage - 1)*$limit;   
$sql = "SELECT * FROM tin  WHERE AnHien=1 AND idLT= $idLT ORDER BY Ngay desc  limit $index, $limit";
$listtin = executeResult($sql);

$sql = "SELECT * FROM loaitin  WHERE idLT= $idLT";
$loaitin = executeResult($sql);
$nameLT="";
$motaLT="";
if(count($result)>0) {
    $nameLT = $loaitin[0]['Ten'];
    $motaLT = $loaitin[0]['MoTa'];
}

?>
<div class="listNewAnnAd">
    <div class="categoryNews">
        <div class="title">
            <h1 style="margin:0"><b><?= $nameLT ?></b></h1>
        </div>
        <?php if (trim($motaLT)!="") { ?>
        <h2 class="motaLT"><?= $motaLT ?></h2>
        <?php } ?>
        <div class="listNews">
            <?php  foreach ($listtin as $item) { ?>
            <div class="mottin d-block d-sm-grid my-2">
                <div class="hinhcuatin">
                <img class='img-fluid img-thumbnail w-100' src='<?=$item['urlHinh'] == '' ? BASE_DIR."images/defaultimg.jpg" : $item['urlHinh']?>' alt='' align="left">
                </div>
                <div class='news-content'>
                    <h3>
                    <a href='<?=BASE_DIR."bv/".$item['slug'].".html"?>' class='news'>
                        <?=$item['TieuDe']?>
                    </a>
                    </h3>
                    <span class='date-out'> <?=date('d/m/Y',strtotime($item['Ngay']))?> </span>
                    <p class="tomtat"><?=$item['TomTat'];?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<ul class="pagination">
    <?php 
    $baseDir = BASE_DIR;
    $pageNext = $currentPage+1;
    $pagePrev = $currentPage-1;
    ?>
    <li class="page-item"><a class="page-link" href="<?=BASE_DIR."loai/".$slug."/".$pagePrev."/" ?>">Trước</a></li>
    <?php
    for ($i = 1; $i < $numPage; $i++) {
        if ($i == $currentPage) {
            echo "<li class='page-item active'><a class='page-link' href='{$baseDir}loai/{$slug}/$i/'>$i</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='{$baseDir}loai/{$slug}/$i/'>$i</a></li>";
        }
    }
    ?>
    <li class="page-item"><a class="page-link" href="<?=BASE_DIR."loai/".$slug."/".$pageNext."/" ?>">Sau</a></li>
</ul>
