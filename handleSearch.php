<?php
   require_once './functions.php';
   $value=$_POST['value']??"tôi là một người mới mong bạn có thể giuo";
   
  $sql="SELECT * FROM tin WHERE TieuDe like '%".$value."%'  limit 10";
  $result=executeResult($sql);
  if($result!=null){
    $res=[
      'status'=>1,
      'result'=>$result
    ];
  }
  else{
    $res=[
        'status'=>0
      ];
  }
  echo json_encode($res)
?>