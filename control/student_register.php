<?php
if (isset($_POST['btaddstd'])) {
  $stdYear = $_POST['stdYear'];
  $stdID = $_POST['stdID'];
  $stdName = $_POST['stdName'];
  $stdStatus = $_POST['stdStatus'];
  $stdGroup = $_POST['stdGroup'];
  $stdMainorg = $_POST['stdMainorg'];
  $stdOrgtion = $_POST['stdOrgtion'];
  $stdTc = $_POST['stdTc'];
  $stdPhone = $_POST['stdPhone'];
  $stdEmail = $_POST['stdEmail'];
  $stdFb = $_POST['stdFb'];
  $stdPassword = $_POST['stdPassword'];
  $imgFile = $_FILES['Image']['name'];
  $tmp_dir = $_FILES['Image']['tmp_name'];
  $imgSize = $_FILES['Image']['size'];
  if (filter_var($stdYear, FILTER_VALIDATE_INT) === false) { 
    $errMSG = "กรุณากรอกปีเป็นตัวเลขเท่านั้น";
  }
  if (filter_var($stdName, FILTER_SANITIZE_STRING) === false) { 
    $errMSG = "กรุณากรอกชื่อเป็นตัวอักษรเท่านั้น";
  }
  if (filter_var($stdID, FILTER_VALIDATE_INT) === false) { 
    $errMSG = "กรุณากรอกเลขประจำตัวให้ถูกต้อง";
  }
  if (filter_var($stdEmail, FILTER_VALIDATE_EMAIL) === false) { 
    $errMSG = "กรุณากรอกอีเมล์ให้ถูกต้อง";
  }
  if (empty($stdName)) {
    $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
  } else if (empty($imgFile)) {
    $Image = "default.png";
  } else {
    $upload_dir = '../assets/img/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    // rename uploading image
    $Image = "stdprofile" . "/" . rand(1000, 1000000) . "." . $imgExt;
    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '5MB'
      if ($imgSize < 5000000) {
        move_uploaded_file($tmp_dir, $upload_dir . $Image);
      } else {
        $errMSG = "ขนาดไฟล์รูปน้อยกว่า 5MB";
      }
    } else {
      $errMSG = "อนุญาตไฟล์ประเภท JPG, JPEG, PNG & GIF เท่านั้น";
    }
  }
  //check username
  if ($stdID != "") {

    $stmt = $db->dbConnection()->prepare("SELECT * FROM student WHERE stdID='$stdID'");
    $stmt->execute();
    if ($stmt->rowCount()) {
      $errMSG = "รายชื่อนี้ได้ถูกเพิ่มแล้ว";
    }
  }

  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $db->dbConnection()->prepare('INSERT INTO student(stdYear,stdID,stdName,stdStatus,stdMainorg,stdOrgtion,stdTc,stdGroup,stdPhone,stdEmail,stdFb,stdPassword,stdImage) VALUES
                                                        (:stdYear,:stdID,:stdName,:stdStatus,:stdMainorg,:stdOrgtion,:stdTc,:stdGroup,:stdPhone,:stdEmail,:stdFb,:stdPassword,:stdImage)');
    $stmt->bindParam(':stdYear', $stdYear);
    $stmt->bindParam(':stdID', $stdID);
    $stmt->bindParam(':stdName', $stdName);
    $stmt->bindParam(':stdStatus', $stdStatus);
    $stmt->bindParam(':stdMainorg', $stdMainorg);
    $stmt->bindParam(':stdOrgtion', $stdOrgtion);
    $stmt->bindParam(':stdTc', $stdTc);
    $stmt->bindParam(':stdGroup', $stdGroup);
    $stmt->bindParam(':stdPhone', $stdPhone);
    $stmt->bindParam(':stdEmail', $stdEmail);
    $stmt->bindParam(':stdFb', $stdFb);
    $stmt->bindParam(':stdPassword', $stdPassword);
    $stmt->bindParam(':stdImage', $Image);
    if ($stmt->execute()) {
      $successMSG = "ทำการลงทะเบียนสำเร็จ";
      header("Location:../view/student_login.php");
    } else {
      $errMSG = "พบข้อผิดพลาด";
    }
  }
}