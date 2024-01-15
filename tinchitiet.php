<?php
    require_once "./functions.php";
    $slug = $_GET['slug']??'';
    $idTin = layidTin($slug);
    settype($idTin, "int");
    $sql="SELECT tin.*,loaitin.Ten as tenloaitin,loaitin.idLT FROM tin 
                  INNER JOIN loaitin on tin.idLT=loaitin.idLT
                  WHERE idTin=$idTin ";
    $result=executeSingerResult($sql);
    //lấy ra những bài viết liên quan 
    $idLT=$result['idLT'];
    $limit= NUM_RELATED_POST;
    $sql="SELECT * FROM  tin WHERE idLT=$idLT AND idTin<= $idTin AND AnHien=1 limit 0,$limit ";
    $result2=executeResult($sql);
?>
<html>
<style>
   .infor-1{
       display: flex;
   }
</style>
<div class="listNewAnnAd">
    <div class="categoryNews">
        <div class="categoryNews-header">
            <h1><?= $result['TieuDe']  ?></h1>
            <?php if (trim($result['TomTat'])!="") {?>
            <h2 class="motatin"><?= $result['TomTat']  ?></h2>
            <?php } ?>
            <div class="infor-1">
                <a href=""> <?= mb_convert_case($result['tenloaitin'], MB_CASE_UPPER, 'utf-8') ?></a> 
                &nbsp; &nbsp; 
                <span> Ngày đăng: <?= date('d/m/Y',strtotime($result['Ngay'])) ?></span>
            </div>
            <div class="socails"><button><i class='bx bxs-like'></i>like</button> <button>chia sẻ</button></div>
        </div>
        <div class="contentct">
            <img src=" <?= $result['urlHinh'] ?>" alt="">
             <?= $result['Content'] ?>
        </div>

    </div>
</div>
<div class="listNewAnnAd">
    <div class="related-Posts">
        <div class="related-Posts-header">
            <h3>Bài Viết Liên Quan</h3>
        </div>
        <div class="related-Posts_list">
           <?php
           $baseDir = BASE_DIR;
           foreach ($result2 as $item) {
               $image = $item['urlHinh'] == '' ? BASE_DIR."images/defaultimg.jpg" : $item['urlHinh'];
               $ngay = date('d/m/Y',strtotime($item['Ngay']));
               echo "
                <a href='$baseDir/bv/{$item['slug']}.html' class='card'>
                    <img src='$image' >
                    <div class='card-txt' style='text-align:center'>
                        <span class='card-title'>$item[TieuDe]</span>
                        <span style='height:30px;line-height:30px;' class='card-date'>$ngay</span>
                    </div>
                </a>
                "; }
           ?>
        </div>
    </div>
    <div class="advertisement"> </div>
    <script>
        const contentct=document.querySelectorAll(".contentct table img")
        contentct.forEach(item => {
            item.style.width="100%"
        });
       
    </script>
</div>

</html>