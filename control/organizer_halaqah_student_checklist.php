<?php
if (isset($_POST['btaddhalaqahstd'])) {
  $halaqahchecklist_no = $_POST['halaqahchecklistNo'];
  $halaqahcheckstdID = $_POST['halaqahcheckstdID'];
  $halaqahID = $_POST['halaqah_id'];
  //check username
  if ($halaqahchecklist_no != "" && $halaqahcheckstdID != "") {
    $stmt = $session->runQuery("SELECT * FROM halaqahcheck WHERE halaqahchecklistNo='$halaqahchecklist_no' && halaqahcheckstdID='$halaqahcheckstdID'");
    $stmt->execute();
    if ($stmt->rowCount()) {
      $errMSG = "รายชื่อนี้ได้ถูกเพิ่มแล้ว";
    }
  }
  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery('INSERT INTO halaqahcheck(halaqahchecklistNo,halaqahcheckstdID) VALUES
                                                        (:halaqahchecklistNo, :halaqahcheckstdID)');
    $stmt->bindParam(':halaqahchecklistNo', $halaqahchecklist_no);
    $stmt->bindParam(':halaqahcheckstdID', $halaqahcheckstdID);
    if ($stmt->execute()) {
      $successMSG = "ทำการเพิ่มสำเร็จ";
      header("Location: ../view/organizer_halaqah_student_checklist.php?halaqah_id=$halaqahID&&halaqahchecklist_no=$halaqahchecklist_no");
    } else {
      $errMSG = "พบข้อผิดพลาด";
    }
  }
}
if (isset($_GET['delete_id'])&&($_GET['halaqahchecklist_no'])&&($_GET['halaqah_id'])) {
  $halaqahchecklist_no = $_GET['halaqahchecklist_no'];
  $halaqahID = $_GET['halaqah_id'];
  // it will delete an actual record from db
  if (!isset($errMSG)) {  
    $stmt = $session->runQuery('DELETE FROM halaqahcheck WHERE halaqahcheckNo =:halaqahcheckNo');
    $stmt->bindParam(':halaqahcheckNo', $_GET['delete_id']);
    if($stmt->execute()){
    $successMSG = "ทำการลบสำเร็จ";
    header("refresh:2;../view/organizer_halaqah_student_checklist.php?halaqah_id=$halaqahID&&halaqahchecklist_no=$halaqahchecklist_no");
    }else {
      $errMSG = "ไม่สามารถลบได้";
  }
  }
    else {
        $errMSG = "ไม่สามารถลบได้";
    }
  }
?>