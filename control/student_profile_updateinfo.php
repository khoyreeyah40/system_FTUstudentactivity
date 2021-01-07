<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT student.*,organization.*, teacher.*, mainorg.* FROM student 
                                    JOIN organization ON organization.orgtionNo = student.stdOrgtion
                                    JOIN teacher ON teacher.teacherNo = student.stdTc
                                    JOIN mainorg ON mainorg.mainorgNo = student.stdMainorg
                                    WHERE student.stdID=:stdID ');
    $stmt_update->execute(array(':stdID' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/student_profile.php");
}
if (isset($_POST['btupdateprofile'])) {
    $stdYear = $_POST['stdYear'];
    $stdID = $_POST['stdID'];
    $stdName = $_POST['stdName'];
    $stdStatus = $_POST['stdStatus'];
    $stdMainorg = $_POST['stdMainorg'];
    $stdOrgtion = $_POST['stdOrgtion'];
    $stdTc = $_POST['stdTc'];
    $stdPhone = $_POST['stdPhone'];
    $stdEmail = $_POST['stdEmail'];
    $stdFb = $_POST['stdFb'];
    $stdPassword = $_POST['stdPassword'];
    $Image = $_POST['Image'];
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
    if ($imgFile) {
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
                unlink($upload_dir . $update_row['stdImage']);
                move_uploaded_file($tmp_dir, $upload_dir . $Image);
            } else {
                $errMSG = "ขนาดไฟล์รูปน้อยกว่า 5MB";
            }
        } else {
            $errMSG = "อนุญาตไฟล์ประเภท JPG, JPEG, PNG & GIF เท่านั้น";
        }
    } else {
        // if no image selected the old image remain as it is.
        $Image = $update_row['stdImage']; // old image from database
    }
    //check username
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE student
                                SET stdID=:stdID,
                                stdName=:stdName,
                                stdYear=:stdYear,
                                stdStatus=:stdStatus,
                                stdMainorg=:stdMainorg,
                                stdOrgtion=:stdOrgtion,
                                stdTc=:stdTc,
                                stdPhone=:stdPhone,
                                stdEmail=:stdEmail,
                                stdFb=:stdFb,
                                stdPassword=:stdPassword,
                                stdImage=:stdImage
                                WHERE stdID=:stdID');
        $stmt->bindParam(':stdID', $stdID);
        $stmt->bindParam(':stdYear', $stdYear);
        $stmt->bindParam(':stdName', $stdName);
        $stmt->bindParam(':stdStatus', $stdStatus);
        $stmt->bindParam(':stdMainorg', $stdMainorg);
        $stmt->bindParam(':stdOrgtion', $stdOrgtion);
        $stmt->bindParam(':stdTc', $stdTc);
        $stmt->bindParam(':stdPhone', $stdPhone);
        $stmt->bindParam(':stdEmail', $stdEmail);
        $stmt->bindParam(':stdFb', $stdFb);
        $stmt->bindParam(':stdPassword', $stdPassword);
        $stmt->bindParam(':stdImage', $Image);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/student_profile.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>