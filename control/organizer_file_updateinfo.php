<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT * FROM file  WHERE fileNo=:fileNo');
    $stmt_update->execute(array(':fileNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_file.php");
}
if (isset($_POST['btupdatefile'])) {
    $fileName = $_POST['fileName'];
  $fileStatus = $_POST['fileStatus'];
  $fileAddby = $_POST['fileAddby'];
  $file = $_POST['file'];
  $imgFile = $_FILES['file']['name'];
  $tmp_dir = $_FILES['file']['tmp_name'];
  $imgSize = $_FILES['file']['size'];

  if (empty($fileName)) {
    $errMSG = "กรุณาป้อนข้อมูลให้ครบ";
  } else if($imgFile){
    $upload_dir = '../file/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    // valid image extensions
    $valid_extensions = array('pdf', 'docx', 'xlsx', 'pptx'); // valid extensions
    // rename uploading image
    $file = "announce" . "/" . rand(1000, 1000000) . "." . $imgExt;

    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '5MB'
      unlink($upload_dir.$update_row['fileDoc']);
      move_uploaded_file($tmp_dir, $upload_dir . $file);
    } else {
      $errMSG = "อนุญาตไฟล์ประเภท PDF, DOCX, XLSX & PPTX เท่านั้น";
    }
  }else
  {
    // if no image selected the old image remain as it is.
    $file = $update_row['fileDoc']; // old image from database
  }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE file
                                    SET fileNo=:fileNo,
                                    fileName=:fileName,
                                    fileDoc=:fileDoc,
                                    fileStatus=:fileStatus,
                                    fileAddby=:fileAddby
                                    WHERE fileNo=:fileNo');
        $stmt->bindParam(':fileNo', $fileNo);
        $stmt->bindParam(':fileName', $fileName);
        $stmt->bindParam(':fileDoc', $file);
        $stmt->bindParam(':fileStatus', $fileStatus);
        $stmt->bindParam(':fileAddby', $fileAddby);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_file.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>