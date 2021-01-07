<?php
if (isset($_POST['btaddorgzer'])) {
  $orgzerID = $_POST['orgzerID'];
  $orgzerName = $_POST['orgzerName']; 
  $orgzeruserType = $_POST['orgzeruserType'];
  $orgzerGroup = $_POST['orgzerGroup'];
  $orgzerSec = $_POST['orgzerSec'];
  $orgzerOrgtion = $_POST['orgzerOrgtion'];
  $orgzerMainorg = $_POST['orgzerMainorg'];
  $orgzerPhone = $_POST['orgzerPhone'];
  $orgzerEmail = $_POST['orgzerEmail'];
  $orgzerFb = $_POST['orgzerFb'];
  $orgzerPassword = $_POST['orgzerPassword'];
  $orgzerAddby = $_POST['orgzerAddby'];
  $imgFile = $_FILES['Image']['name'];
  $tmp_dir = $_FILES['Image']['tmp_name'];
  $imgSize = $_FILES['Image']['size'];
  if (filter_var($orgzerName, FILTER_SANITIZE_STRING) === false) { 
    $errMSG = "กรุณากรอกชื่อเป็นตัวอักษรเท่านั้น";
  }
  if (filter_var($orgzerEmail, FILTER_VALIDATE_EMAIL) === false) { 
    $errMSG = "กรุณากรอกอีเมล์ให้ถูกต้อง";
  }
  if (empty($orgzerName)) {
    $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
  } else if (empty($imgFile)) {
    $Image = "default.png";
  } else {
    $upload_dir = '../assets/img/'; // upload directory
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    // rename uploading image
    $Image = "profile" . "/" . rand(1000, 1000000) . "." . $imgExt;

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

  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery('INSERT INTO organizer(orgzerID,orgzerName,orgzeruserType,orgzerGroup,orgzerSec,orgzerOrgtion,orgzerMainorg,orgzerPhone,orgzerEmail,orgzerFb,orgzerPassword,orgzerAddby, orgzerImage) VALUES
                                                        (:orgzerID,:orgzerName, :orgzeruserType,:orgzerGroup,:orgzerSec,:orgzerOrgtion,:orgzerMainorg,:orgzerPhone,:orgzerEmail,:orgzerFb,:orgzerPassword,:orgzerAddby,:orgzerImage)');
    $stmt->bindParam(':orgzerID', $orgzerID);
    $stmt->bindParam(':orgzerName', $orgzerName);
    $stmt->bindParam(':orgzeruserType', $orgzeruserType);
    $stmt->bindParam(':orgzerGroup', $orgzerGroup);
    $stmt->bindParam(':orgzerSec', $orgzerSec);
    $stmt->bindParam(':orgzerOrgtion', $orgzerOrgtion);
    $stmt->bindParam(':orgzerMainorg', $orgzerMainorg);
    $stmt->bindParam(':orgzerPhone', $orgzerPhone);
    $stmt->bindParam(':orgzerEmail', $orgzerEmail);
    $stmt->bindParam(':orgzerFb', $orgzerFb);
    $stmt->bindParam(':orgzerPassword', $orgzerPassword);
    $stmt->bindParam(':orgzerAddby', $orgzerAddby);
    $stmt->bindParam(':orgzerImage', $Image);
    if ($stmt->execute()) {
      $stmt = $session->runQuery(" SELECT orgzerNo FROM organizer ORDER BY orgzerNo DESC limit 1");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $no = $row["orgzerNo"];
      $orgzerID = str_pad($no, 5, "0", STR_PAD_LEFT);
      $orgzerIDlist = "ORG" . $orgzerID;

      $stmt = $session->runQuery('UPDATE organizer SET orgzerID=:orgzerIDlist WHERE orgzerNo=:orgzerno');
      $stmt->bindParam(':orgzerIDlist', $orgzerIDlist);
      $stmt->bindParam(':orgzerno', $no);
      if ($stmt->execute()) {
        $successMSG = "ทำการเพิ่มสำเร็จ";
        header("refresh:2; ../view/organizer_organizer.php");
      } else {
        $errMSG = "พบข้อผิดพลาด";
      }
    }
  }
}
if (isset($_GET['delete_id'])) {
  // it will delete an actual record from db
  $stmt = $session->runQuery('DELETE FROM organizer WHERE orgzerID = :orgzerid');
  $stmt->bindParam(':orgzerid', $_GET['delete_id']);
	if ($stmt->execute()) {
    $stmt = $session->runQuery('SELECT orgzerImage FROM organizer WHERE orgzerID = :orgzerid');
    $stmt->bindParam(':orgzerid', $_GET['delete_id']);          
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
              unlink("../assets/img/profile/" . $row['orgzerImage']);
    $successMSG = "ทำการลบสำเร็จ";
    header("Location: ../view/organizer_organizer.php");
	} else {
		$errMSG = "ไม่สามารถทำการลบได้เนื่องข้อมูลถูกนำไปใช้แล้ว";
	}
	
}
?>