<?php
if (isset($_GET['halaqahcheck_id'])) {
  $halaqahID = $_GET['halaqahcheck_id'];

  $stmt = $session->runQuery("SELECT * FROM acttype WHERE acttypeName='กลุ่มศึกษาอัลกุรอาน'");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $acttype = $row["acttypeNo"];


  $stmt = $session->runQuery('INSERT INTO halaqahchecklist(halaqahID,actSem, halaqahcheckliststatus,halaqahacttype) VALUES
                                                        (:halaqahID, 1, "เปิดการลงทะเบียน",:halaqahtype )');
  $stmt->bindParam(':halaqahID', $halaqahID);
  $stmt->bindParam(':halaqahtype', $acttype);
  if ($stmt->execute()) {
    $successMSG = "ทำการเพิ่มสำเร็จ";
    header("Location: ../view/organizer_halaqah_checklist_sem1.php?halaqah_id=$halaqahID");
  } else {
    $errMSG = "พบข้อผิดพลาด";
  }
}
if (isset($_GET['status_id']) && ($_GET['halaqah_id'])) {
  $halaqahID = $_GET['halaqah_id'];
  $stmt = $session->runQuery('UPDATE halaqahchecklist 
                                 SET halaqahcheckliststatus="ปิดการลงทะเบียน"
                                  WHERE halaqahchecklistNo=:checklistno');
  $stmt->bindParam(':checklistno', $_GET['status_id']);
  if ($stmt->execute()) {
    header("Location: ../view/organizer_halaqah_checklist_sem1.php?halaqah_id=$halaqahID");
  } else {
    $errMSG = "พบข้อผิดพลาด";
  }
}
if (isset($_GET['delete_id']) && ($_GET['halaqah_id'])) {
  // it will delete an actual record from db
  $halaqahID = $_GET['halaqah_id'];
  $stmt_delete = $session->runQuery('DELETE FROM halaqahchecklist WHERE halaqahchecklistNo =:halaqahchecklistNo');
  $stmt_delete->bindParam(':halaqahchecklistNo', $_GET['delete_id']);
  if ($stmt_delete->execute()) {
    header("Location: ../view/organizer_halaqah_checklist_sem1.php?halaqah_id=$halaqahID");
  } else {
    $errMSG = "ไม่สามารถลบได้";
  }
}
