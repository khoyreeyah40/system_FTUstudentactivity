<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT * FROM board WHERE boardNo=:boardNo');
    $stmt_update->execute(array(':boardNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_board.php");
}
if (isset($_POST['btupdateboard'])) {
    $boardNo = $_POST['boardNo'];
    $boardName = $_POST['boardName']; // user name
    $boardStatus = $_POST['boardStatus'];
    $boardLink = $_POST['boardLink'];
    $boardDiscribe = $_POST['boardDiscribe'];
    $boardAddby = $_POST['boardAddby'];
    $Image = $_POST['Image'];
    $imgFile = $_FILES['Image']['name'];
    $tmp_dir = $_FILES['Image']['tmp_name'];
    $imgSize = $_FILES['Image']['size'];
    if($boardLink !=""){
      if (filter_var($boardLink, FILTER_VALIDATE_URL) === false) { 
        $errMSG = "ลิ้งค์ใบประเมินกรุณาคัดลอกURLเท่านั้น";
      }}
    if($imgFile) {
        $upload_dir = '../assets/img/'; // upload directory
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        // rename uploading image
        $Image = "board" . "/" . rand(1000, 1000000) . "." . $imgExt;
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
          // Check file size '5MB'
            unlink($upload_dir.$update_row['board']);
            move_uploaded_file($tmp_dir, $upload_dir . $Image);
        } else {
          $errMSG = "กรุณาอัพโหลดไฟล์ภาพเป็น JPG, JPEG, PNG & GIF เท่านั้น";
        }
      }else
      {
        // if no image selected the old image remain as it is.
        $Image = $update_row['board']; // old image from database
      }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE board
                                    SET boardNo=:boardNo,
                                    boardName=:boardName,
                                    board=:board,
                                    boardStatus=:boardStatus,
                                    boardLink=:boardLink,
                                    boardDiscribe=:boardDiscribe,
                                    boardAddby=:boardAddby
                                    WHERE boardNo=:boardNo');
        $stmt->bindParam(':boardNo', $boardNo);
        $stmt->bindParam(':boardName', $boardName);
        $stmt->bindParam(':board', $Image);
        $stmt->bindParam(':boardStatus', $boardStatus);
        $stmt->bindParam(':boardLink', $boardLink);
        $stmt->bindParam(':boardDiscribe', $boardDiscribe);
        $stmt->bindParam(':boardAddby', $boardAddby);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_board.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>