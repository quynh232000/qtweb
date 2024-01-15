<?php
  require_once "config.php";
  // tiến Hành  kết nối php
  function execute($sql){
    $conn= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    mysqli_set_charset($conn, "utf8");
    $result=mysqli_query($conn,$sql);
    mysqli_close($conn);
    return $result;
  }
  function stripUnicode($str){
  if(!$str) return false;
  $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
      'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
      'd'=>'đ', 'D'=>'Đ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
      'i'=>'í|ì|ỉ|ĩ|ị', 'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
      'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
  );
  foreach($unicode as $khongdau=>$codau) {
      $arr=explode("|",$codau);
      $str = str_replace($arr,$khongdau,$str);
    }
    return $str;
  }
  function getTitle($page, $defaultTile){
    $db_Host = DB_HOST; 
    $db_User= DB_USERNAME;
    $db_Pass= DB_PASSWORD; 
    $db_Name = DB_NAME;
    if ($page=="tinchitiet"){
      $slug = $_GET['slug']??'';
      $sql = "SELECT TieuDe FROM tin WHERE slug=?";
      $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
      $st = $conn->prepare($sql);
       $st->execute( [$slug] );
      $data = $st->fetchAll(PDO::FETCH_ASSOC); 
      if (count($data)==0) return $defaultTile;
      return $data[0]['TieuDe'];
    }
    if ($page=="tintrongloai"){
      $slug = $_GET['slug']??'';
      $sql = "SELECT Ten FROM loaitin WHERE slug=?";
      $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
      $st = $conn->prepare($sql);
       $st->execute( [$slug] );
      $data = $st->fetchAll(PDO::FETCH_ASSOC); 
      if (count($data)==0) return $defaultTile;
      return $data[0]['Ten'];
    }
    else  {
      return $defaultTile;
    }
  }
  function getDescription($page){
    $db_Host = DB_HOST; 
    $db_User= DB_USERNAME;
    $db_Pass= DB_PASSWORD; 
    $db_Name = DB_NAME;
    if ($page=="tinchitiet"){
      $slug = $_GET['slug']??'';
      $sql = "SELECT TomTat FROM tin WHERE slug=?";
      $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
      $st = $conn->prepare($sql);
       $st->execute( [$slug] );
      $data = $st->fetchAll(); 
      if (count($data)==0) return "";
      return $data[0][0];
    }
    else if ($page=="tintrongloai"){
      $slug = $_GET['slug']??'';
      $sql = "SELECT MoTa FROM loaitin WHERE slug=?";
      $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
      $st = $conn->prepare($sql);
       $st->execute( [$slug] );
      $data = $st->fetchAll(); 
      if (count($data)==0) return "";
      return $data[0][0];
    }
    else if ($page=="home" || $page==""){
      global $site_info;      
      return $site_info['gioithieu'];
    }
    else return "";
    
   
  }
  function slug($str){
    $str = stripUnicode($str);
    $str = str_replace(['$','%','"',"'",'?','#','@','(',')','!','-',';','&'], '', $str);
    $str= trim($str);
    while (strpos('  ',$str)>0) $str = str_replace('  ',' ',$str);
    $str = str_replace(' ','-',$str);
    $str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
    return $str;
  }
  function executeResult($sql)  {
    $conn= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    mysqli_set_charset($conn, "utf8");
    $result=mysqli_query($conn,$sql);
    $data=[];
    if($result!=null){
        while ($row=mysqli_fetch_assoc($result)) {
            $data[]=$row;
        }
    }
    mysqli_close($conn);
    return $data;
  }
  function executeSingerResult($sql){
    $conn= mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    mysqli_set_charset($conn, "utf8");
       $result=mysqli_query($conn,$sql);
       $row=""; 
       if($result!=null){
          $row=mysqli_fetch_array($result,1);
      }
    mysqli_close($conn);
    return $row;
  }
  function checklogin(){
    if (isset($_SESSION['un'])==true) return true;
    else return false;
  }  
  function layidTin($tieude_KhongDau){
    $sql = "SELECT idTin FROM tin WHERE slug=?";
    $db_Host = DB_HOST; 
    $db_User= DB_USERNAME;
    $db_Pass= DB_PASSWORD; 
    $db_Name = DB_NAME;
    $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
    $st = $conn->prepare($sql);
    $st->execute( [$tieude_KhongDau] );
    $data = $st->fetchAll(PDO::FETCH_ASSOC); 
    if (count($data)==0) return -1;
    return $data[0]['idTin'];
  }
  function layidLT($ten_KhongDau){
    $sql = "SELECT idLT FROM loaitin WHERE slug=?";
    $db_Host = DB_HOST; 
    $db_User= DB_USERNAME;
    $db_Pass= DB_PASSWORD; 
    $db_Name = DB_NAME;
    $conn =new PDO("mysql:host={$db_Host};dbname={$db_Name};charset=utf8","{$db_User}","{$db_Pass}");
    $st = $conn->prepare($sql);
    $st->execute( [$ten_KhongDau] );
    $data = $st->fetchAll(PDO::FETCH_ASSOC); 
    if (count($data)==0) return -1;
    return $data[0]['idLT'];
  }
?>