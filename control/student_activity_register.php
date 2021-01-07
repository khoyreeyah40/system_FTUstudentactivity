<?php
if (isset($_GET['actreg_id'])) {
    $actid = $_GET['actreg_id'];
    if ($actid != "" && $stdUser != "") {
        $stmt = $session->runQuery("SELECT * FROM actregister WHERE actregactID='$actid' && actregstdID='$stdUser'");
        $stmt->execute();
        if ($stmt->rowCount()) {

            $errMSG = "รายชื่อนี้ได้ทำการลงทะเบียนแล้ว";
        }
    }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('INSERT INTO actregister(actregactID,actregstdID,actregStatus) VALUES
                                                        (:actregactID,:actregstdID,"รอยืนยันการเข้าร่วม")');
        $stmt->bindParam(':actregactID', $actid);
        $stmt->bindParam(':actregstdID', $stdUser);
        if ($stmt->execute()) {
            $successMSG = "ทำการลงทะเบียนสำเร็จ";
            header("refresh:2;../view/student_activity_register.php");
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>