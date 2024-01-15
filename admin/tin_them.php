<?php
session_start();
require_once "../functions.php";
$page = "tin";
?>
<?php
$msg="";
$sql="SELECT * FROM loaitin ORDER BY ThuTu";
$listLT = executeResult($sql);

if(isset($_POST['submit'])){
   $TieuDe = $_POST['TieuDe']??"";
   $TomTat = $_POST['TomTat']??"";
   $AnHien = $_POST['AnHien']??0;
   $lang = $_POST['lang']??"vi";
   $idLT = $_POST['idLT']??0;
   $urlHinh = $_POST['urlHinh']??"";
   $Content = $_POST['Content']??"";
   $NoiBat = $_POST['NoiBat']??0;
   if ($TieuDe!="" && $TomTat!="" && $Content!='' &&  $idLT>0 ) {
      $slug = slug($TieuDe);
      $sql="INSERT INTO tin SET 
         TieuDe='$TieuDe', TomTat='$TomTat',  Content='$Content',
         AnHien='$AnHien', lang='$lang' , idLT= '$idLT'  , 
         urlHinh='$urlHinh',NoiBat = $NoiBat , slug= '$slug'
         ";
      $kq=execute($sql); 
      header('Location: index.php?page=tin'); exit();
   }
   else{ $msg="<span class='p-3'>Vui lòng nhập đầy đủ thông tin</span>";}
}
?>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <link rel="stylesheet" href="./main.css">
   
   <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/super-build/ckeditor.js"></script>
   <title>Quản trị web tổng hợp</title>
   <style>
      .error-msg {
         width: 100%;
         text-align: center;
         color: rgb(92, 2, 2);
         background: rgba(218, 77, 77, 0.729);
         border-radius: 5px;
         margin: 5px 0;
         font-weight: 600;
      }
   </style>
</head>
<body>
   <!-- Nav tabs -->
   <div class="container">
   <?php require_once "menu.php";?>
   <!-- Tab panes -->
   <div class="tab-content">
      <div class="tab-pane active" id="">
      <div class="col-10 m-auto" >
         <h2 class="py-2 text-center h4 ">THÊM TIN MỚI</h2>
         <form action="" method="post">
            <div class="mb-3">
                  <label>Tên đề tin</label>
                  <input class="form-control bg-light" type="text" name="TieuDe" value="<?= $_POST['TieuDe']??"" ?>">
            </div>
            <div class="mb-3">
                  <label>Mô tả tin</label>
                  <textarea name="TomTat" class="form-control bg-light"><?= $_POST['TomTat']??"" ?></textarea>
            </div>
            <div class="mb-3">
                  <label>Địa chỉ hình</label>
                  <input class="form-control bg-light" type="text" name="urlHinh" value="<?= $_POST['urlHinh']??"" ?>">
            </div>
            <div class="mb-3">
               <label>Trong loại tin:</label>
               <select name="idLT"class="form-control bg-light">
                  <option value="0">--Chọn loại tin--</option>
                  <?php
                  foreach ($listLT as $item) echo "<option value=$item[idLT] > $item[Ten] </option>";
                  ?>
               </select>
            </div>
            <div class="mb-3">
               <b style="min-width:10px">Ẩn Hiện:</b>
               <input type="radio" name="AnHien" value="0" checked> Ẩn
               <input type="radio" name="AnHien" value="1"> Hiện
               &nbsp; &nbsp; &nbsp; &nbsp; 
               <b>Ngôn ngữ:</b>
               <input type="radio" name="lang" value="vi" checked> Việt Nam
               <input type="radio" name="lang" value="en"> English
               &nbsp; &nbsp; &nbsp; &nbsp; 
               <b>Nổi bật: </b>
               <input type="radio" name="NoiBat" value="1" > Tin nổi bật
               <input type="radio" name="NoiBat" value="0" checked> Tin thường
            </div>    
            <div class="mb-3">
            <textarea name="Content" id="Content" class="form-control bg-light"><?= $_POST['Content']??"" ?></textarea>
            </div>        
            <div class="mb-3">
            <button class="btn btn-success px-3" name="submit"> &nbsp; Lưu &nbsp; </button>
            </div>
            <div class="error-msg text-white">
            <?= $msg??"" ?>   
         </div>
         </form>
         </div>
      </div>
   </div>
   </div>
</body>

</html>


<script>
   CKEDITOR.ClassicEditor.create(document.getElementById("Content"), {
         toolbar: {
            items: [
               'heading', '|','findAndReplace', 'selectAll', '|',
               'bold', 'italic', 'underline', 'subscript', 'superscript', 'removeFormat', '|',
               'bulletedList', 'numberedList', '|','outdent', 'indent', '|',
               '-',
               'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
               'alignment', '|',
               'link', 'insertImage', 'insertTable', 'mediaEmbed', '|',
                'horizontalLine', '|','sourceEditing'
            ],
            shouldNotGroupWhenFull: true
         },
         // Changing the language of the interface requires loading the language file using the <script> tag.
         // language: 'es',
         list: {
            properties: {
               styles: true,
               startIndex: true,
               reversed: true
            }
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
         heading: {
            options: [
               { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
               { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
               { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
               { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
               { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
               { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
               { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
         placeholder: 'Welcome to CKEditor 5!',
         // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
         fontFamily: {
            options: [
               'default',
               'Arial, Helvetica, sans-serif',
               'Courier New, Courier, monospace',
               'Georgia, serif',
               'Lucida Sans Unicode, Lucida Grande, sans-serif',
               'Tahoma, Geneva, sans-serif',
               'Times New Roman, Times, serif',
               'Trebuchet MS, Helvetica, sans-serif',
               'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
         fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
         },
         // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
         // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
         htmlSupport: {
            allow: [
               {
                     name: /.*/,
                     attributes: true,
                     classes: true,
                     styles: true
               }
            ]
         },
         // Be careful with enabling previews
         // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
         htmlEmbed: {
            showPreviews: true
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
         link: {
            decorators: {
               addTargetToExternalLinks: true,
               defaultProtocol: 'https://',
               toggleDownloadable: {
                     mode: 'manual',
                     label: 'Downloadable',
                     attributes: {
                        download: 'file'
                     }
               }
            }
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
         mention: {
            feeds: [
               {
                     marker: '@',
                     feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                     ],
                     minimumCharacters: 1
               }
            ]
         },
         // The "super-build" contains more premium features that require additional configuration, disable them below.
         // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
         removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType
            'MathType'
         ]
   });
</script>
<style>
.ck-editor__editable_inline {
    min-height: 250px;
    max-height: 450px;
}
</style>