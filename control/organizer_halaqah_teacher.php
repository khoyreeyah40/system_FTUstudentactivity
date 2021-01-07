<?php
if (isset($_POST['btaddhalaqahtc'])) {
  $halaqahtcYear = $_POST['halaqahtcYear'];
  $halaqahtcID = $_POST['halaqahtcID'];
  $halaqahtcMainorg = $_POST['halaqahtcMainorg'];
  $halaqahtcAddby = $_POST['halaqahtcAddby'];

  if (empty($halaqahtcYear)) {
    $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
  }
  //check username
  if ($halaqahtcYear != "" && $halaqahtcID != "" && $halaqahtcMainorg != "") {

    $stmt = $session->runQuery("SELECT * FROM halaqahtc WHERE halaqahtcYear='$halaqahtcYear' && halaqahtcID='$halaqahtcID' && halaqahtcMainorg='$halaqahtcMainorg'");
    $checkexist = $stmt->execute();
    if ($stmt->rowCount($checkexist)) {
      $errMSG = "รายชื่อนี้ได้ถูกเพิ่มในปีการศึกษานี้แล้ว";
    }
  }
  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery('INSERT INTO halaqahtc(halaqahtcYear,halaqahtcID, halaqahtcMainorg, halaqahtcAddby) VALUES
                                                        (:halaqahtcYear, :halaqahtcID, :halaqahtcMainorg,:halaqahtcAddby)');
    $stmt->bindParam(':halaqahtcYear', $halaqahtcYear);
    $stmt->bindParam(':halaqahtcID', $halaqahtcID);
    $stmt->bindParam(':halaqahtcMainorg', $halaqahtcMainorg);
    $stmt->bindParam(':halaqahtcAddby', $halaqahtcAddby);
    if ($stmt->execute()) {
      $successMSG = "ทำการเพิ่มสำเร็จ";
      header("refresh:2;../view/organizer_halaqah_teacher.php");
    } else {
      $errMSG = "พบข้อผิดพลาด";
    }
  }
}
if (isset($_GET['halaqahtc_id'])) {

  $stmt = $session->runQuery('UPDATE halaqahtc 
                                 SET halaqahtcStatus="สำเร็จกิจกรรมแล้ว"
                                  WHERE halaqahtcNo=:halaqahtcno');
  $stmt->bindParam(':halaqahtcno', $_GET['halaqahtc_id']);
  $stmt->execute();

  header("Location: ../view/organizer_halaqah_teacher.php");
}

if (isset($_GET['delete_id'])) {
  // it will delete an actual record from db
  if (!isset($errMSG)) {  
    $stmt = $session->runQuery('DELETE FROM halaqahtc WHERE halaqahtcNo =:halaqahtcno');
    $stmt->bindParam(':halaqahtcno', $_GET['delete_id']);
    if($stmt->execute()){
    $successMSG = "ทำการลบสำเร็จ";
    header("Location: ../view/organizer_halaqah_teacher.php");
    }else {
      $errMSG = "ไม่สามารถลบได้";
  }
  }
    else {
        $errMSG = "ไม่สามารถลบได้";
    }
  }
?>