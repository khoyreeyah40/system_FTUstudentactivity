<?php
if (isset($_POST['btaddfile'])) {
  $fileName = $_POST['fileName'];
  $fileStatus = $_POST['fileStatus'];
  $fileAddby = $_POST['fileAddby'];
  $imgFile = $_FILES['file']['name'];
  $tmp_dir = $_FILES['file']['tmp_name'];
  $imgSize = $_FILES['file']['size'];

  if (empty($fileName)) {
    $errMSG = "กรุณาป้อนข้อมูลให้ครบ";
  } else if (empty($imgFile)) {
    $errMSG = "กรุณาแนบไฟล์กิจกรรม";
  } else {
    $upload_dir = '../file/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    // valid image extensions
    $valid_extensions = array('pdf', 'docx', 'xlsx', 'pptx'); // valid extensions
    // rename uploading image
    $file = "announce" . "/" . rand(1000, 1000000) . "." . $imgExt;

    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '5MB'
      move_uploaded_file($tmp_dir, $upload_dir . $file);
    } else {
      $errMSG = "อนุญาตไฟล์ประเภท PDF, DOCX, XLSX & PPTX เท่านั้น";
    }
  }
  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery("INSERT INTO file(fileName,fileStatus, fileDoc, fileAddby) VALUES
                                                (:fileName, 'แสดง',:fileDoc, :fileAddby)");
    $stmt->bindParam(':fileName', $fileName);
    $stmt->bindParam(':fileAddby', $fileAddby);
    $stmt->bindParam(':fileDoc', $file);
    if ($stmt->execute()) {
      $successMSG = "ทำการเพิ่มสำเร็จ";
      header("refresh:2;../view/organizer_file.php");
    } else {
      $errMSG = "เกิดข้อผิดพลากกรุณาเพิ่มใหม่อีกครั้ง....";
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
  }else{
    $errMSG="ไม่สามารถลบได้";
  }
}
?>