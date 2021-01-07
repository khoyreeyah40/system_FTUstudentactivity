<?php
if (isset($_POST['btaddboard'])) {
  $boardName = $_POST['boardName'];
  $boardStatus = $_POST['boardStatus'];
  $boardDiscribe = $_POST['boardDiscribe'];
  $boardLink = $_POST['boardLink'];
  $boardAddby = $_POST['boardAddby'];

  $imgFile = $_FILES['Image']['name'];
  $tmp_dir = $_FILES['Image']['tmp_name'];
  $imgSize = $_FILES['Image']['size'];
  if($boardLink !=""){
  if (filter_var($boardLink, FILTER_VALIDATE_URL) === false) { 
    $errMSG = "ลิ้งค์ใบประเมินกรุณาคัดลอกURLเท่านั้น";
  }}
  if (empty($boardStatus)) {
    $errMSG = "กรุณาป้อนข้อมูลให้ครบ";
  } else if (empty($imgFile)) {
    $errMSG = "กรุณาเพิ่มรูปภาพ";
  } else {
    $upload_dir = '../assets/img/'; // upload directory

    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

    // rename uploading image
    $Image = "board" . "/" . rand(1000, 1000000) . "." . $imgExt;

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
  //check username
  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery("INSERT INTO board(boardName, boardStatus, boardDiscribe,boardLink, boardAddby, board) VALUES
                                                (:boardName, :boardStatus, :boardDiscribe,:boardLink, :boardAddby, :board)");
    $stmt->bindParam(':boardName', $boardName);
    $stmt->bindParam(':boardStatus', $boardStatus);
    $stmt->bindParam(':boardDiscribe', $boardDiscribe);
    $stmt->bindParam(':boardLink', $boardLink);
    $stmt->bindParam(':boardAddby', $boardAddby);
    $stmt->bindParam(':board', $Image);
    if ($stmt->execute()) {
      $successMSG = "ทำการเพิ่มสำเร็จ";
      header("refresh:2;../view/organizer_board.php");
    } else {
      $errMSG = "เกิดความผิดพลาดกรุณาเพิ่มใหม่อีกครั้ง....";
    }
  }
}
if (isset($_GET['delete_id'])) {
  $stmt_select = $session->runQuery('SELECT board FROM board WHERE boardNo =:boardNo');
  $stmt_select->execute(array(':boardNo' => $_GET['delete_id']));
  $boardRow = $stmt_select->fetch(PDO::FETCH_ASSOC);

  unlink("../assets/img/profile/" . $boardRow['board']);

  // it will delete an actual record from db
  $stmt_delete = $session->runQuery('DELETE FROM board WHERE boardNo =:boardNo');
  $stmt_delete->bindParam(':boardNo', $_GET['delete_id']);
  if($stmt_delete->execute()){
    $successMSG ="ทำการลบสำเร็จ";
    header("Location: ../view/organizer_board.php");
  }else{
    $errMSG = "ไม่สามารถลบได้";
  }
}
?>