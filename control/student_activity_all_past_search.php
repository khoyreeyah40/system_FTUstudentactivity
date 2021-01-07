<?php
if (isset($_POST['btsearch'])) {
    $actYear = $_POST['actYear'];
    if (empty($actYear)) {
      $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }
    if (filter_var($actYear, FILTER_VALIDATE_INT) === false) { 
      $errMSG = "กรุณากรอกปีการศึกษาให้ถูกต้อง";
    }
    if(!isset($errMSG)){
      header("Location: ../view/student_act_all_past.php?actYear=$actYear");
    }
}
?>