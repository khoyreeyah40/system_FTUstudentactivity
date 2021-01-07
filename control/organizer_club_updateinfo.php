<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT club.*, organization.*, mainorg.*, student.* FROM club 
                                JOIN organization ON organization.orgtionNo = club.clubOrgtion
                                JOIN mainorg ON mainorg.mainorgNo = club.clubMainorg
                                JOIN student ON student.stdID = club.clubstdID
                                WHERE clubNo = :clubNo ');
    $stmt_update->execute(array(':clubNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_club.php");
}
if (isset($_POST['btupdateclub'])) {
    $clubYear = $_POST['clubYear'];
    $clubstdID = $_POST['clubstdID'];
    $clubPst = $_POST['clubPst'];
    $clubOrgtion = $_POST['clubOrgtion'];
    $clubMainorg = $_POST['clubMainorg'];
    $clubAddby = $_POST['clubAddby'];

    if (empty($clubPst)) {
        $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }
    //check username
    if ($clubPst != "" && $clubstdID != "" && $clubYear != "" && $clubOrgtion != "" && $clubMainorg != "") {

        $stmt = $session->runQuery("SELECT * FROM club WHERE clubPst='$clubPst' && clubstdID='$clubstdID' && clubYear='$clubYear' && clubOrgtion='$clubOrgtion' && clubMainorg='$clubMainorg'");
        $checkexist = $stmt->execute();
        if ($stmt->rowCount($checkexist)) {
            $errMSG = "รายชื่อนี้ได้ถูกเพิ่มแล้ว";
        }
    }
    if (($clubstdID != "")) {
        $stmt = $session->runQuery("SELECT * FROM student WHERE stdID='$clubstdID' ");
        $stmt->execute();
        if ($stmt->rowCount()==0) {
          $errMSG = "ไม่พบรหัสนักศึกษานี้ กรุณากรอกใหม่อีกครั้งคะ";
        }
      }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE club
                                    SET 
                                    clubNo=:clubNo,
                                    clubYear=:clubYear,
                                    clubstdID=:clubstdID,
                                    clubPst=:clubPst,
                                    clubOrgtion=:clubOrgtion,
                                    clubAddby=:clubAddby,
                                    clubMainorg=:clubMainorg
                                    WHERE clubNo=:clubNo');
        $stmt->bindParam(':clubNo', $clubNo);
        $stmt->bindParam(':clubYear', $clubYear);
        $stmt->bindParam(':clubstdID', $clubstdID);
        $stmt->bindParam(':clubPst', $clubPst);
        $stmt->bindParam(':clubOrgtion', $clubOrgtion);
        $stmt->bindParam(':clubMainorg', $clubMainorg);
        $stmt->bindParam(':clubAddby', $clubAddby);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_club.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>