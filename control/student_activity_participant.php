<?php
if (isset($_POST['btaddfile'])) {
    $year = $_POST['year'];
    $stdid = $_POST['stdid'];
    $acttype = $_POST['acttype'];
    $imgFile = $_FILES['file']['name'];
    $tmp_dir = $_FILES['file']['tmp_name'];
    $imgSize = $_FILES['file']['size'];

    if (empty($imgFile)) {
        $errMSG = "กรุณาแนบไฟล์กิจกรรม";
    } else {
        $upload_dir = '../file/'; // upload directory
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('pdf', 'docx', 'xlsx', 'pptx'); // valid extensions
        // rename uploading image
        $file = "eiatiqaf" . "/" . rand(1000, 1000000) . "." . $imgExt;

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
        $stmt = $session->runQuery("INSERT INTO eiatiqaf(eiatiqafstdID,eiatiqafYear, eiatiqafactType, eiatiqafFile) VALUES
                                                (:eiatiqafstdID,:eiatiqafYear,:eiatiqafactType,:eiatiqafFile)");
        $stmt->bindParam(':eiatiqafstdID', $stdid);
        $stmt->bindParam(':eiatiqafYear', $year);
        $stmt->bindParam(':eiatiqafactType', $acttype);
        $stmt->bindParam(':eiatiqafFile', $file);
        if ($stmt->execute()) {
            $successMSG = "ทำการเพิ่มสำเร็จ";
            header("refresh; ../view/student_activity_paticipant.php");
        } else {
            $errMSG = "error while inserting....";
        }
    }
}
if (isset($_GET['delete_id'])) {
  $stmt_select = $session->runQuery('SELECT * FROM eiatiqaf WHERE eiatiqafNo =:eiatiqafNo');
  $stmt_select->execute(array(':eiatiqafNo' => $_GET['delete_id']));
  $eiatiqafRow = $stmt_select->fetch(PDO::FETCH_ASSOC);

  unlink("../file/" . $eiatiqafRow['eiatiqafFile']);

  // it will delete an actual record from db
  $stmt_delete = $session->runQuery('DELETE FROM eiatiqaf WHERE eiatiqafNo =:eiatiqafNo');
  $stmt_delete->bindParam(':eiatiqafNo', $_GET['delete_id']);
  $stmt_delete->execute();

  header("Location: ../view/student_activity_participant.php");
}
