<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
  $id = $_GET['update_id'];
  $stmt_update = $session->runQuery('SELECT activity.*, mainorg.*,organization.*, acttype.* FROM activity
                                        JOIN mainorg ON activity.actMainorg = mainorg.mainorgNo
                                        JOIN organization ON activity.actOrgtion = organization.orgtionNo
                                        JOIN acttype ON activity.actType = acttype.acttypeNo
                                        WHERE activity.actID=:actID');
  $stmt_update->execute(array(':actID' => $id));
  $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
  extract($update_row);
} else {
  header("Location: ../view/organizer_activity.php");
}
if (isset($_POST['btupdateact'])) {
  $actID = $_POST['actID'];
  $actYear = $_POST['actYear'];
  $actName = $_POST['actName']; // user name
  $actSem = $_POST['actSem'];
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
  $actNote = $_POST['actNote'];
  $actAssesslink = $_POST['actAssesslink'];
  $actAddby = $_POST['actAddby'];
  $actFile = $_POST['actFile'];
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
  } else if ($imgFile) {
    $upload_dir = '../file/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    // valid image extensions
    $valid_extensions = array('pdf', 'docx', 'xlsx', 'pptx'); // valid extensions
    // rename uploading image
    $actFile = "act" . "/" . rand(1000, 1000000) . "." . $imgExt;

    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '5MB'
      unlink($upload_dir . $update_row['actFile']);
      move_uploaded_file($tmp_dir, $upload_dir . $actFile);
    } else {
      $errMSG = "อนุญาตไฟล์ประเภท PDF, DOCX, XLSX & PPTX เท่านั้น";
    }
  } else {
    // if no image selected the old image remain as it is.
    $actFile = $update_row['actFile']; // old image from database
  }
  if (!isset($errMSG)) {
    $stmt = $session->runQuery('UPDATE activity
                                    SET actID=:actID,
                                    actYear=:actYear,
                                    actName=:actName,
                                    actSem=:actSem,
                                    actSec=:actSec,
                                    actMainorg=:actMainorg,
                                    actOrgtion=:actOrgtion,
                                    actType=:actType,
                                    actGroup=:actGroup,
                                    actReason=:actReason,
                                    actPurpose=:actPurpose,
                                    actStyle=:actStyle,
                                    actTimeb=:actTimeb,
                                    actTimee=:actTimee,
                                    actDateb=:actDateb,
                                    actDatee=:actDatee,
                                    actLocate=:actLocate,
                                    actPay=:actPay,
                                    actNote=:actNote,
                                    actAssesslink=:actAssesslink,
                                    actAddby=:actAddby,
                                    actFile=:actFile
                                    WHERE actID=:actID');
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
?>
      <script>
        alert('ทำการแก้ไขเรียบร้อย ...');
        window.location.href = '../view/organizer_activity.php';
      </script>
<?php
    } else {
      $errMSG = "พบข้อผิดพลาด";
    }
  }
}
?>