<ul class="nav nav-tabs">
    <li class="nav-item">
    <a class="nav-link <?php if($page=='theloai') echo 'active'  ?>  " data-toggle="tab" href="index.php?page=theloai">Danh mục thể loại</a>
    </li>
    <li class="nav-item">
    <a class="nav-link"  <?php if($page=='loaitin') echo 'active'  ?>  data-toggle="tab" href="index.php?page=loaitin">Danh mục loại tin</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" <?php if($page=='tin') echo 'active'  ?>  data-toggle="tab" href="index.php?page=tin">Quản lý tin tức </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" <?php if($page=='user') echo 'active'  ?>  data-toggle="tab" href="index.php?page=user">Danh sách người dùng </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" <?php if($page=='thongtin') echo 'active'  ?>  data-toggle="tab" href="index.php?page=thongtin">Thông tin </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger" href="#">Chào <?=$_SESSION['un']?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../" target="public">Public</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="thoat.php">Thoát </a>
    </li>
</ul>
