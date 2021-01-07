<?php
if (isset($_POST['btaddhalaqahstd'])) {
  $halaqahID = $_POST['halaqahID'];
  $halaqahstdID = $_POST['halaqahstdID'];

  if (empty($halaqahstdID)) {
    $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
  }
  //check username
  if (($halaqahID != "") && ($halaqahstdID != "")) {
    $stmt = $session->runQuery("SELECT * FROM halaqahstd WHERE halaqahstdID='$halaqahstdID' && halaqahID='$halaqahID'");
    $stmt->execute();
    if ($stmt->rowCount()) {
      $errMSG = "รายชื่อนี้ได้ถูกเพิ่มในปีการศึกษานี้แล้ว";
    }
  }
  if (($halaqahstdID != "")) {
    $stmt = $session->runQuery("SELECT * FROM student WHERE stdID='$halaqahstdID' ");
    $stmt->execute();
    if ($stmt->rowCount()==0) {
      $errMSG = "ไม่พบรหัสนักศึกษานี้ กรุณากรอกใหม่อีกครั้งคะ";
    }
  }
  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery('INSERT INTO halaqahstd(halaqahID,halaqahstdID) VALUES
                                                        (:halaqahID, :halaqahstdID)');
    $stmt->bindParam(':halaqahID', $halaqahID);
    $stmt->bindParam(':halaqahstdID', $halaqahstdID);
    if ($stmt->execute()) {
      $successMSG = "ทำการเพิ่มสำเร็จ";
      header("refresh;../view/organizer_halaqah_student_add.php?halaqah_id=$halaqahID");
    } else {
      $errMSG = "พบข้อผิดพลาด";
    }
  }
}
 

if (isset($_GET['delete_id'])&&($_GET['halaqah_id'])) {
  // it will delete an actual record from db
  $halaqahID = $_GET['halaqah_id'];
  if (!isset($errMSG)) {  
    $stmt = $session->runQuery('DELETE FROM halaqahstd WHERE halaqahstdID =:halaqahstdID && halaqahID =:halaqahID');
    $stmt->bindParam(':halaqahstdID', $_GET['delete_id']);
    $stmt->bindParam(':halaqahID', $_GET['halaqah_id']);
    if($stmt->execute()){
    $successMSG = "ทำการลบสำเร็จ";
    header("refresh:2;../view/organizer_halaqah_student_add.php?halaqah_id=$halaqahID");
    }else {
      $errMSG = "ไม่สามารถลบได้";
  }
  }
    else {
        $errMSG = "ไม่สามารถลบได้";
    }
  }
?>