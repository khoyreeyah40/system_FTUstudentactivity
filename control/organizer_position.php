<?php
if (isset($_POST['btaddposition'])) {
    $pstYear = $_POST['pstYear'];
    $pststdID = $_POST['pststdID'];
    $pst = $_POST['pst'];
    $pstOrgtion = $_POST['pstOrgtion'];
    $pstMainorg = $_POST['pstMainorg'];
    $pstAddby = $_POST['pstAddby'];

    if (empty($pst)) 
    {
        $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }
    //check username
    if ($pst != ""&& $pststdID != ""&& $pstYear != ""&& $pstOrgtion != ""&& $pstMainorg != "") {

        $stmt = $session->runQuery("SELECT * FROM pst WHERE pst='$pst' && pststdID='$pststdID' && pstYear='$pstYear' && pstOrgtion='$pstOrgtion' && pstMainorg='$pstMainorg'");
        $stmt->execute();
        if ($stmt->rowCount()) 
        {
            $errMSG = "รายชื่อนี้ได้ถูกเพิ่มแล้ว";
        }
    }
    if (($pststdID != "")) {
        $stmt = $session->runQuery("SELECT * FROM student WHERE stdID='$pststdID' ");
        $stmt->execute();
        if ($stmt->rowCount()==0) 
        {
          $errMSG = "ไม่พบรหัสนักศึกษานี้ กรุณากรอกใหม่อีกครั้งคะ";
        }
      }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery("INSERT INTO pst(pstYear, pststdID,  pst,  pstOrgtion, pstMainorg, pstAddby) VALUES
                                                (:pstYear, :pststdID, :pst, :pstOrgtion, :pstMainorg, :pstAddby)");
        $stmt->bindParam(':pstYear', $pstYear);
        $stmt->bindParam(':pststdID', $pststdID);
        $stmt->bindParam(':pst', $pst);
        $stmt->bindParam(':pstOrgtion', $pstOrgtion);
        $stmt->bindParam(':pstMainorg', $pstMainorg);
        $stmt->bindParam(':pstAddby', $pstAddby);
        if ($stmt->execute()) 
        {
            $successMSG = "ทำการเพิ่มสำเร็จ";
            header("refresh; ../view/organizer_position.php");
        } else {
            $errMSG = "error while inserting....";
        }
    }
}
if (isset($_GET['delete_id'])) {
    // it will delete an actual record from db
    if (!isset($errMSG)) {
    $stmt_delete = $session->runQuery('DELETE FROM pst WHERE pstNo =:pstNo');
    $stmt_delete->bindParam(':pstNo', $_GET['delete_id']);
    if($stmt_delete->execute()){
    header("Location: ../view/organizer_position.php");
    }else {
        $errMSG = "เกิดข้อผิดพลาด....";
      }
    }
    else {
        $errMSG = "ไม่สามารถลบได้";
    }
}
?>