<?php
$sql = "SELECT tin.*,loaitin.Ten as nameLT FROM tin, loaitin WHERE tin.idLT=loaitin.idLT AND tin.AnHien=1  ORDER BY Ngay desc  limit 0," . NUM_POST_HOMEPAGE;
$result2 = executeResult($sql);
?>
<div class="tintrongngay">
<div class="categoryNews">
    <div class="title">
        <b class="tags">Tin tức trong ngày </b>
    </div>
    <div class="listNews">
        <?php foreach ($result2 as $item) {?>
        <div class="mottin d-block d-sm-grid my-2" >
            <div class="hinhcuatin">
            <a href="<?=BASE_DIR.'bv/'.$item['slug'].'.html'?>">
            <img class='img-fluid img-thumbnail w-100' src='<?=$item['urlHinh'] ??  BASE_DIR."images/404.jpg"?>' alt=''>
            </a>
            </div>
            <div class='news-content'>                        
                <h3 class="m-0">
                <a href="<?=BASE_DIR.'bv/'.$item['slug'].'.html'?>" class="news"> 
                <?=$item['TieuDe']?>
                </a>
                </h3>
                <p class="mt-1 d-none d-sm-block">
                <b class='typeOfName'>Loại: <?=$item['nameLT']?></b> &nbsp; 
                <em class='date-out'> Ngày đăng: <?=date('d/m/Y',strtotime($item['Ngay']))?></em>
                </p>
                <p><?=$item['TomTat']?></p>
            </div>
        </div>
        <?php }?>
    </div>            
</div>
<h1 class="gioithieuwebsite"><?=$site_info['gioithieu']?></h1>
</div>

