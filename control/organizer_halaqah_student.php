<?php
if (isset($_POST['btaddhalaqahstd'])) {
  $halaqahID = $_POST['halaqahID'];
  $halaqahstdID = $_POST['halaqahstdID'];
  if (filter_var($halaqahstdID, FILTER_VALIDATE_INT) === false) { 
    $errMSG = "กรอกรหัสนักศึกษาเป็นตัวเลขเท่านั้น";
  }
  if (empty($halaqahstdID)) {
    $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
  }
  //check username
  if ($halaqahID != "" && $halaqahstdID != "") {
    $stmt = $session->runQuery("SELECT * FROM halaqahstd WHERE halaqahstdID='$halaqahstdID' && halaqahID='$halaqahID'");
    $checkexist = $stmt->execute();
    if ($stmt->rowCount($checkexist)) {
      $errMSG = "รายชื่อนี้ได้ถูกเพิ่มในปีการศึกษานี้แล้ว";
    }
  }
  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery('INSERT INTO halaqahstd(halaqahID,halaqahstdID, halaqahstdStatus) VALUES
                                                        (:halaqahID, :halaqahstdID, "")');
    $stmt->bindParam(':halaqahID', $halaqahID);
    $stmt->bindParam(':halaqahstdID', $halaqahstdID);
    if ($stmt->execute()) {
      $successMSG = "ทำการเพิ่มสำเร็จ";
      header("refresh:2;organizer_halaqah_student.php?halaqah_id=$halaqahID");
    } else {
      $errMSG = "พบข้อผิดพลาด";
    }
  }
}
?>