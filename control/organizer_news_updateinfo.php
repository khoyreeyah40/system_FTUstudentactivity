<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT * FROM news WHERE newsNo=:newsNo');
    $stmt_update->execute(array(':newsNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_news.php");
}
if (isset($_POST['btupdatenews'])) {
    $newsTitle = $_POST['newsTitle'];
    $newsStatus = $_POST['newsStatus'];
    $newsDescribe = $_POST['newsDescribe'];
    $newsAddby = $_POST['newsAddby'];
    $Image = $_POST['Image'];
    $imgFile = $_FILES['Image']['name'];
    $tmp_dir = $_FILES['Image']['tmp_name'];
    $imgSize = $_FILES['Image']['size'];
  
    if (empty($newsTitle)) {
      $errMSG = "กรุณาป้อนข้อมูลให้ครบ";
    } else if($imgFile) {
      $upload_dir = '../assets/img/'; // upload directory
  
      $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
  
      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
      // rename uploading image
      $Image = "news" . "/" . rand(1000, 1000000) . "." . $imgExt;
  
      // allow valid image file formats
      if (in_array($imgExt, $valid_extensions)) {
        // Check file size '5MB'
        unlink($upload_dir.$update_row['newsImage']);
          move_uploaded_file($tmp_dir, $upload_dir . $Image);
        
      } else {
        $errMSG = "กรุณาอัพโหลดไฟล์ภาพเป็น JPG, JPEG, PNG & GIF เท่านั้น";
      }
    }else
    {
      // if no image selected the old image remain as it is.
      $Image = $update_row['newsImage']; // old image from database
    }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE news
                                    SET 
                                    newsNo=:newsNo,
                                    newsTitle=:newsTitle,
                                    newsDescribe=:newsDescribe,
                                    newsStatus=:newsStatus,
                                    newsImage=:newsImage,
                                    newsAddby=:newsAddby
                                    WHERE newsNo=:newsNo');
        $stmt->bindParam(':newsNo', $newsNo);
        $stmt->bindParam(':newsTitle', $newsTitle);
        $stmt->bindParam(':newsImage', $Image);
        $stmt->bindParam(':newsStatus', $newsStatus);
        $stmt->bindParam(':newsDescribe', $newsDescribe);
        $stmt->bindParam(':newsAddby', $newsAddby);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_news.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>