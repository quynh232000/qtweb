<?php
    require_once "../functions.php";
    if (checklogin()==false){  header('Location: login.php'); exit(); }
    $sql="SELECT tin.*,loaitin.Ten FROM tin 
                  LEFT JOIN loaitin on tin.idLT=loaitin.idLT
                  ORDER BY idTin DESC ";
    $result=executeResult($sql);
?>
<div class="container">
    <h2 class="py-2 text-center h4 ">QUẢN LÝ TIN TỨC</h2>
    <table class="table table-hover table-bordered">
    <thead  class="thead-dark" >
    <tr>
        <th>Danh sách các tin</th>
        <th style='width:200px'>Thông tin</th>            
        <th style='width:60px'>            
            <a  class="btn btn-warning px-3 py-1" href="./tin_them.php">Thêm</a>
        </th>
    </tr>
    </thead>
    <tbody>        
    <?php
    foreach ($result as $item) {                
        $lang = $item['lang']=='vi'?"Vietnamese":'English';
        $anHien= $item['AnHien']?"Đang hiện":'Đang ẩn';
        $noibat= $item['NoiBat']==1? "<b>Tin nổi bật</b>":'<i>Tin thường</i>';
        $dir = BASE_DIR;
        echo 
        "<tr>
            <td> 
                <img src='$dir$item[urlHinh]' width='200' height='150' align='left' class='mr-3'>
                <h4>$item[TieuDe]</h4>
                <div>$item[TomTat]</div>
                <span class='text-success'>
                    Ngày đăng: $item[Ngay] . 
                    Số lần xem: $item[SoLanXem]
                </span>
            </td>
            <td>Trạng thái: $anHien <br>
                Ngôn ngữ: $lang <br>
                Trong loại: $item[Ten] <br>
                $noibat
            </td>                       
            <td><div> 
                <a href='./tin_sua.php?idTin=$item[idTin]'><button class='btn btn-warning'><i class='bx bx-edit-alt'></i></button></a>
                </div>
                <div class='mt-1'>
                <button class='btn btn-danger' onclick='deleteTin($item[idTin])'><i class='bx bx-trash'></i></button>
                </div>
            </td>
        </tr>";
    }//foreach
    ?>
    </tbody>
</table>
</div>

<!-- PHẦN VIẾT AJAX LÀM VIỆC VỚI PHP -->
 <script>
     deleteTin=(id)=>{
         let check=confirm("Bạn có chắc chắn xóa không ??")
         console.log(id)
       if(check){
         $.post("tin_xoa.php",{'idTin':id},
         (data)=>{ 
             console.log(data);
             if(data== 0) location.reload(); else alert(data); 
        })
       }
     }
 </script>
