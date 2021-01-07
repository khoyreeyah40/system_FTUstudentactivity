<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT pst.*, organization.*, mainorg.*, student.* FROM pst 
                                                JOIN organization ON organization.orgtionNo = pst.pstOrgtion
                                                JOIN mainorg ON mainorg.mainorgNo = pst.pstMainorg
                                                JOIN student ON student.stdID = pst.pststdID
                                                WHERE pstNo = :pstNo ');
    $stmt_update->execute(array(':pstNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_position.php");
}
if (isset($_POST['btupdateposition'])) {
    $pstYear = $_POST['pstYear'];
    $pststdID = $_POST['pststdID'];
    $pst = $_POST['pst'];
    $pstOrgtion = $_POST['pstOrgtion'];
    $pstMainorg = $_POST['pstMainorg'];
    $pstAddby = $_POST['pstAddby'];

    if (empty($pst)) {
        $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }
    //check username
    if ($pst != "" && $pststdID != "" && $pstYear != "" && $pstOrgtion != "" && $pstMainorg != "") {
        $stmt = $session->runQuery("SELECT * FROM pst WHERE pst='$pst' && pststdID='$pststdID' && pstYear='$pstYear' && pstOrgtion='$pstOrgtion' && pstMainorg='$pstMainorg'");
        $stmt->execute();
        if ($stmt->rowCount()) {
            $errMSG = "รายชื่อนี้ได้ถูกเพิ่มแล้ว";
        }
    }
    if (($pststdID != "")) {
        $stmt = $session->runQuery("SELECT * FROM student WHERE stdID='$pststdID' ");
        $stmt->execute();
        if ($stmt->rowCount()==0) {
          $errMSG = "ไม่พบรหัสนักศึกษานี้ กรุณากรอกใหม่อีกครั้งคะ";
        }
    }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE pst
                                    SET 
                                    pstNo=:pstNo,
                                    pstYear=:pstYear,
                                    pststdID=:pststdID,
                                    pst=:pst,
                                    pstOrgtion=:pstOrgtion,
                                    pstAddby=:pstAddby,
                                    pstMainorg=:pstMainorg
                                    WHERE pstNo=:pstNo');
        $stmt->bindParam(':pstNo', $pstNo);
        $stmt->bindParam(':pstYear', $pstYear);
        $stmt->bindParam(':pststdID', $pststdID);
        $stmt->bindParam(':pst', $pst);
        $stmt->bindParam(':pstOrgtion', $pstOrgtion);
        $stmt->bindParam(':pstMainorg', $pstMainorg);
        $stmt->bindParam(':pstAddby', $pstAddby);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_position.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>