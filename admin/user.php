<?php
   require_once "../functions.php";
   $sql="SELECT * FROM users";
   $result=executeResult($sql);
?>
<div class="container">
    <h2 class="py-2 text-center h4 ">QUẢN LÝ NGƯỜI DÙNG</h2>
    <table class="table table-hover table-bordered">
    <thead  class="thead-dark" >
        <tr>
            <th style="width:100px">Hình Ảnh </th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Mật Khẩu</th>
            <th>Giới Tính</th>
            <th>Nghề Nghiệp</th>
            <th>Sở Thích</th>
            <th>Quyền Hạn</th>
            <th colspan="2">
            <a class="btn btn-success" href="./user_them_sua.php">Thêm Mới</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($result as $item) {
                $gt= $item['gt']?"Nữ":'Nam';
                $admin= $item['group_id']?"admin":'khách';

                echo "<tr>
                        <td>  <img  style=\"width:100%\"  src=\"../upload/images/$item[file_img]\" alt=\"\"></td>
                        <td>$item[user_name]</td>
                        <td>$item[email]</td>
                        <td>$gt</td>
                        <td>$item[hobby]</td>
                        <td>$item[nghe_nghiep]</td>
                        <td>$item[intro]</td>
                        <td>$admin</td>
                        <td style=\"width:60px\"><a href=\"./user_them_sua.php?idLT=$item[user_id]\"><button class=\"btn btn-warning\"><i class='bx bx-edit-alt'></i></button></a></td>
                        <td style=\"width:60px\"><button class=\"btn btn-danger\" onclick=\"deleteUser($item[user_id])\"><i class='bx bx-trash'></i></button></td>
                    </tr>";
            }
        ?>
    </tbody>
</table>

</div>

<!-- PHẦN VIẾT AJAX LÀM VIỆC VỚI PHP -->
 <script>
     deleteUser=(id)=>{
        let check=confirm("Bạn có chắc chắn xóa không ??")
        console.log(id)
       if(check){
         $.post("user_xoa.php", { 'user_id':id}, (data)=>{
            if(data== 0) location.reload();  else alert(data);            
         })
       }
     }
 </script>
