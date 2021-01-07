<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT organizer.*, usertype.*, mainorg.*, organization.* FROM organizer
        JOIN usertype ON organizer.orgzeruserType = usertype.usertypeID
        JOIN mainorg ON organizer.orgzerMainorg = mainorg.mainorgNo
        JOIN organization ON organizer.orgzerOrgtion = organization.orgtionNo
        WHERE organizer.orgzerID = :orgzerid');
    $stmt_update->execute(array(':orgzerid' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_organizer.php");
}
if (isset($_POST['btupdateorgzer'])) {
    $orgzerID = $_POST['orgzerID'];
    $orgzerName = $_POST['orgzerName']; // user name
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
    $Image = $_POST['Image'];
    $imgFile = $_FILES['Image']['name'];
    $tmp_dir = $_FILES['Image']['tmp_name'];
    $imgSize = $_FILES['Image']['size'];
    if (filter_var($orgzerName, FILTER_SANITIZE_STRING) === false) { 
      $errMSG = "กรุณากรอกชื่อเป็นตัวอักษรเท่านั้น";
    }
    if (filter_var($orgzerEmail, FILTER_VALIDATE_EMAIL) === false) { 
      $errMSG = "กรุณากรอกอีเมล์ให้ถูกต้อง";
    }
    if($imgFile){
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
            unlink($upload_dir.$update_row['orgzerImage']);
            move_uploaded_file($tmp_dir, $upload_dir . $Image);
          } else {
            $errMSG = "ขนาดไฟล์รูปน้อยกว่า 5MB";
          }
        } else {
          $errMSG = "อนุญาตไฟล์ประเภท JPG, JPEG, PNG & GIF เท่านั้น";
        }
      }else
      {
        // if no image selected the old image remain as it is.
        $Image = $update_row['orgzerImage']; // old image from database
      }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE organizer
                                    SET orgzerID=:orgzerID,
                                    orgzerName=:orgzerName,
                                    orgzeruserType=:orgzeruserType,
                                    orgzerGroup=:orgzerGroup,
                                    orgzerSec=:orgzerSec,
                                    orgzerOrgtion=:orgzerOrgtion,
                                    orgzerMainorg=:orgzerMainorg,
                                    orgzerPhone=:orgzerPhone,
                                    orgzerEmail=:orgzerEmail,
                                    orgzerFb=:orgzerFb,
                                    orgzerPassword=:orgzerPassword,
                                    orgzerAddby=:orgzerAddby,
                                    orgzerImage=:orgzerImage
                                    WHERE orgzerID=:orgzerID');
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
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_organizer.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>