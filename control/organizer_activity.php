<?php
if (isset($_POST['btaddact'])) {
  $actID = $_POST['actID'];
  $actYear = $_POST['actYear'];
  $actSem = $_POST['actSem'];
  $actName = $_POST['actName'];
  $actSec = $_POST['actSec'];
  $actMainorg = $_POST['actMainorg'];
  $actOrgtion = $_POST['actOrgtion'];
  $actType = $_POST['actType'];
  $actGroup = $_POST['actGroup'];
  $actReason = $_POST['actReason'];
  $actPurpose = $_POST['actPurpose'];
  $actStyle = $_POST['actStyle'];
  $actTimeb = $_POST['actTimeb'];
  $actTimee = $_POST['actTimee'];
  $actDateb = $_POST['actDateb'];
  $actDatee = $_POST['actDatee'];
  $actLocate = $_POST['actLocate'];
  $actPay = $_POST['actPay'];
  $actAssesslink = $_POST['actAssesslink'];
  $actNote = $_POST['actNote'];
  $actAddby = $_POST['actAddby'];
  $imgFile = $_FILES['actFile']['name'];
  $tmp_dir = $_FILES['actFile']['tmp_name'];
  $imgSize = $_FILES['actFile']['size'];
  if ($actPay != "") {
    if (filter_var($actPay, FILTER_VALIDATE_INT) === false) {
      $errMSG = "ค่าลงทะเบียนกรุณากรอกเป็นเพียงตัวเลขเท่านั้น";
    }
  }
  if ($actAssesslink != "") {
    if (filter_var($actAssesslink, FILTER_VALIDATE_URL) === false) {
      $errMSG = "ลิ้งค์ใบประเมินกรุณาคัดลอกURLเท่านั้น";
    }
  }
  if (empty($actName)) {
    $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
  } 
  else if($imgFile){
    $upload_dir = '../file/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    // valid image extensions
    $valid_extensions = array('pdf', 'docx', 'xlsx', 'pptx'); // valid extensions
    // rename uploading image
    $actFile = "act" . "/" . rand(1000, 1000000) . "." . $imgExt;

    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '5MB'
      move_uploaded_file($tmp_dir, $upload_dir . $actFile);
    } else {
      $errMSG = "อนุญาตไฟล์ประเภท PDF, DOCX, XLSX & PPTX เท่านั้น";
    }
  }
  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery('INSERT INTO activity(actID, actYear,actSem,actStatus,actName,actSec,actMainorg,actOrgtion,actType,actGroup,actReason,actPurpose,actStyle,actTimeb,actTimee,actDateb,actDatee,actLocate,actPay,actAssesslink, actAddby,actNote, actFile) VALUES
                                                        (:actID, :actYear, :actSem,"ลงในแผน",:actName,:actSec,:actMainorg,:actOrgtion,:actType,:actGroup,:actReason,:actPurpose,:actStyle,:actTimeb,:actTimee,:actDateb,:actDatee,:actLocate,:actPay,:actAssesslink,:actAddby,:actNote, :actFile)');

    $stmt->bindParam(':actID', $actID);
    $stmt->bindParam(':actYear', $actYear);
    $stmt->bindParam(':actSem', $actSem);
    $stmt->bindParam(':actName', $actName);
    $stmt->bindParam(':actSec', $actSec);
    $stmt->bindParam(':actMainorg', $actMainorg);
    $stmt->bindParam(':actOrgtion', $actOrgtion);
    $stmt->bindParam(':actType', $actType);
    $stmt->bindParam(':actGroup', $actGroup);
    $stmt->bindParam(':actReason', $actReason);
    $stmt->bindParam(':actPurpose', $actPurpose);
    $stmt->bindParam(':actStyle', $actStyle);
    $stmt->bindParam(':actTimeb', $actTimeb);
    $stmt->bindParam(':actTimee', $actTimee);
    $stmt->bindParam(':actDateb', $actDateb);
    $stmt->bindParam(':actDatee', $actDatee);
    $stmt->bindParam(':actLocate', $actLocate);
    $stmt->bindParam(':actPay', $actPay);
    $stmt->bindParam(':actAssesslink', $actAssesslink);
    $stmt->bindParam(':actNote', $actNote);
    $stmt->bindParam(':actAddby', $actAddby);
    $stmt->bindParam(':actFile', $actFile);
    if ($stmt->execute()) {
      $stmt = $session->runQuery("SELECT actNo FROM activity ORDER BY actNo DESC limit 1");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $no = $row["actNo"];
      $actID = str_pad($no, 5, "0", STR_PAD_LEFT);
      $actIDlist = "A" . $actID;

      $stmt = $session->runQuery('UPDATE activity 
                                 SET actID=:actIDlist
                                  WHERE actNo=:actno');
      $stmt->bindParam(':actno', $no);
      $stmt->bindParam(':actIDlist', $actIDlist);
      if($stmt->execute()){
        $successMSG = "ทำการเพิ่มสำเร็จ";
        header("refresh:2;../view/organizer_activity.php");
      } else {
        $errMSG = "พบข้อผิดพลาด";
      }
    }
  }
}
if (isset($_GET['act1_id'])) {

  $stmt = $session->runQuery('UPDATE activity 
                                 SET actStatus="ดำเนินกิจกรรม"
                                  WHERE actNo=:actno');
  $stmt->bindParam(':actno', $_GET['act1_id']);
  $stmt->execute();

  header("Location: ../view/organizer_activity.php");
}
if (isset($_GET['act2_id'])) {

  $stmt = $session->runQuery('UPDATE activity 
                                 SET actStatus="ลงในแผน"
                                  WHERE actNo=:actno');
  $stmt->bindParam(':actno', $_GET['act2_id']);
  $stmt->execute();

  header("Location: ../view/organizer_activity.php");
}
if (isset($_GET['actfinish_id'])) {

  $stmt = $session->runQuery('UPDATE activity 
                                 SET actStatus="ปิดการลงทะเบียน"
                                  WHERE actNo=:actno');
  $stmt->bindParam(':actno', $_GET['actfinish_id']);
  $stmt->execute();

  header("Location: ../view/organizer_activity.php");
}
if (isset($_GET['delete_id'])) {
  $stmt = $session->runQuery('DELETE FROM activity WHERE actNo=:actno');
  $stmt->bindParam(':actno', $_GET['delete_id']);
  if($stmt->execute()){
    $successMSG = "ทำการลบสำเร็จ";
    header("Location: ../view/organizer_activity.php");
	} else {
		$errMSG = "ไม่สามารถทำการลบได้เนื่องข้อมูลถูกนำไปใช้แล้ว";
	}
}
?>