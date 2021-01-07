<?php
if (isset($_POST['btaddnews'])) {
  $newsTitle = $_POST['newsTitle'];
  $newsStatus = $_POST['newsStatus'];
  $newsDescribe = $_POST['newsDescribe'];
  $newsAddby = $_POST['newsAddby'];
  $imgFile = $_FILES['Image']['name'];
  $tmp_dir = $_FILES['Image']['tmp_name'];
  $imgSize = $_FILES['Image']['size'];

  if (empty($newsTitle)) {
    $errMSG = "กรุณาป้อนข้อมูลให้ครบ";
  } else if (empty($imgFile)) {
    $errMSG = "กรุณาเพิ่มรูปภาพ";
  } else {
    $upload_dir = '../assets/img/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    // rename uploading image
    $Image = "news" . "/" . rand(1000, 1000000) . "." . $imgExt;
    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '5MB'
      if ($imgSize < 5000000) {
        move_uploaded_file($tmp_dir, $upload_dir . $Image);
      } else {
        $errMSG = "ขนาดของภาพไม่เกิน 5MB";
      }
    } else {
      $errMSG = "กรุณาอัพโหลดไฟล์ภาพเป็น JPG, JPEG, PNG & GIF เท่านั้น";
    }
  }
  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery("INSERT INTO news(newsTitle,newsStatus, newsDescribe, newsAddby, newsImage) VALUES
                                                (:newsTitle, 'แสดง',:newsDescribe, :newsAddby, :newsImage)");
    $stmt->bindParam(':newsTitle', $newsTitle);
    $stmt->bindParam(':newsDescribe', $newsDescribe);
    $stmt->bindParam(':newsAddby', $newsAddby);
    $stmt->bindParam(':newsImage', $Image);
    if ($stmt->execute()) {
      $successMSG = "ทำการเพิ่มสำเร็จ";
      header("refresh:2;../view/organizer_news.php");
    } else {
      $errMSG = "error while inserting....";
    }
  }
}
if (isset($_GET['delete_id'])) {
  $stmt_select = $session->runQuery('SELECT newsImage FROM news WHERE newsNo =:newsNo');
  $stmt_select->execute(array(':newsNo' => $_GET['delete_id']));
  $newsRow = $stmt_select->fetch(PDO::FETCH_ASSOC);
  unlink("../assets/img/" . $newsRow['newsImage']);
  // it will delete an actual record from db
  $stmt_delete = $session->runQuery('DELETE FROM news WHERE newsNo =:newsNo');
  $stmt_delete->bindParam(':newsNo', $_GET['delete_id']);
  if($stmt_delete->execute()){

  header("Location: ../view/organizer_news.php");
  }else {
    $errMSG = "เกิดข้อผิดพลาด....";
  }
}
?>