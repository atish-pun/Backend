<?php
class ImageModule{
   public static function upload($target_dir){
      if(!isset($_FILES["uploadFile"])){ return ""; }
      if($_FILES['uploadFile']['size'] <= 0) return "";

      $FileNameRandomID = md5(microtime().rand(111111, 9999999));
      $target_file = $target_dir .$FileNameRandomID."_". basename($_FILES["uploadFile"]["name"]);
      $fileName = $FileNameRandomID."_". basename($_FILES["uploadFile"]["name"]);
      move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file);
      return $fileName;
   }
}
?>