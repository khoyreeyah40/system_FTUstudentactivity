<?php
if (isset($_POST['btsearch'])) {
    $stdMainorg = $_POST['stdMainorg'];
    $stdOrgtion = $_POST['stdOrgtion'];
    $stdYear = $_POST['stdYear'];
    $stdGroup = $_POST['stdGroup'];
    if (empty($stdMainorg)) {
      $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }else if (empty($stdOrgtion)) {
      $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }else if (empty($stdYear)) {
      $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }else if (empty($stdGroup)) {
      $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }
    if(!isset($errMSG)){
      header("Location: ../view/organizer_activity_examine.php?stdMainorg=$stdMainorg&&stdOrgtion=$stdOrgtion&&stdYear=$stdYear&&stdGroup=$stdGroup");
    } else {
      $errMSG = "พบข้อผิดพลาด";
    }
}
if (isset($_POST['btsearch1'])) {
  $stdID = $_POST['stdID'];
  if (($stdID != "")) {
    $stmt = $session->runQuery("SELECT * FROM student WHERE stdID='$stdID' ");
    $stmt->execute();
    if ($stmt->rowCount()==0) {
      $errMSG = "ไม่พบรหัสนักศึกษานี้ กรุณากรอกใหม่อีกครั้งคะ";
    }
  }
  if (filter_var($stdID, FILTER_VALIDATE_INT) === false) { 
    $errMSG = "กรุณากรอกรหัสนักศึกษาให้ถูกต้อง";
  }
  if (empty($stdID)) {
    $errMSG = "กรุณากรอกรหัสนักศึกษาให้ครบถ้วน";
  }
  if(!isset($errMSG)){
    header("Location: ../view/organizer_activity_participant.php?stdUser=$stdID");
  } else {
    $errMSG = "พบข้อผิดพลาด";
  }
}
?>