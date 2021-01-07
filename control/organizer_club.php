<?php
if (isset($_POST['btaddclub'])) {
    $clubYear = $_POST['clubYear'];
    $clubstdID = $_POST['clubstdID'];
    $clubPst = $_POST['clubPst'];
    $clubOrgtion = $_POST['clubOrgtion'];
    $clubMainorg = $_POST['clubMainorg'];
    $clubAddby = $_POST['clubAddby'];

    if (empty($clubPst)) {
        $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }    
    //check club
    if ($clubPst != "" && $clubstdID != "" && $clubYear != "" && $clubOrgtion != "" && $clubMainorg != "") {

        $stmt = $session->runQuery("SELECT * FROM club WHERE clubPst='$clubPst' && clubstdID='$clubstdID' && clubYear='$clubYear' && clubOrgtion='$clubOrgtion' && clubMainorg='$clubMainorg'");
        $stmt->execute();
        if ($stmt->rowCount()) {
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
        $stmt = $session->runQuery("INSERT INTO club(clubYear, clubstdID,  clubPst, clubOrgtion, clubMainorg, clubAddby) VALUES
                                                (:clubYear, :clubstdID, :clubPst,:clubOrgtion, :clubMainorg, :clubAddby)");
        $stmt->bindParam(':clubYear', $clubYear);
        $stmt->bindParam(':clubstdID', $clubstdID);
        $stmt->bindParam(':clubPst', $clubPst);
        $stmt->bindParam(':clubOrgtion', $clubOrgtion);
        $stmt->bindParam(':clubMainorg', $clubMainorg);
        $stmt->bindParam(':clubAddby', $clubAddby);
        if ($stmt->execute()) {
            $successMSG = "ทำการเพิ่มสำเร็จ";
            header("refresh;../view/organizer_club.php");
        } else {
            $errMSG = "เกิดข้อผิดพลากกรุณาเพิ่มใหม่อีกครั้ง....";
        }
    }  
}
if (isset($_GET['delete_id'])) {
    // it will delete an actual record from db
    $stmt_delete = $session->runQuery('DELETE FROM club WHERE clubNo =:clubNo');
    $stmt_delete->bindParam(':clubNo', $_GET['delete_id']);
    if($stmt_delete->execute()){
    header("Location: ../view/organizer_club.php");
    }else{
        $errMSG ="ไม่สามารถลบได้";
    }
}
?>