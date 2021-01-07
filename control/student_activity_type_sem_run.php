<?php
if (isset($_GET['actreg2_id']) && ($_GET['acttype']) && ($_GET['actyear']) && ($_GET['actsem'])) {
    $actid = $_GET['actreg2_id'];
    $acttype = $_GET['acttype'];
    $actyear = $_GET['actyear'];
    $actsem = $_GET['actsem'];

    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('INSERT INTO actregister(actregactID,actregstdID,actregStatus) VALUES
                                                        (:actregactID,:actregstdID,"จำนงแก้กิจกรรม")');
        $stmt->bindParam(':actregactID', $actid);
        $stmt->bindParam(':actregstdID', $stdUser);
        if ($stmt->execute()) {
            $successMSG = "ทำการจำนงแก้กิจกรรมสำเร็จ";
            header("Location: ../view/student_activity_type_sem_run.php?acttype=$acttype&&actyear=$actyear&&actsem=$actsem");
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
if (isset($_GET['actreg1_id']) && ($_GET['acttype']) && ($_GET['actyear']) && ($_GET['actsem'])) {
    $acttype = $_GET['acttype'];
    $actyear = $_GET['actyear'];
    $actsem = $_GET['actsem'];
    // it will delete an actual record from db
    $stmt_delete = $session->runQuery('DELETE FROM actregister WHERE actregNo =:actregno');
    $stmt_delete->bindParam(':actregno', $_GET['actreg1_id']);
    if($stmt_delete->execute()){
    $successMSG = "ทำการจำนงแก้กิจกรรมสำเร็จ";
    header("Location: ../view/student_activity_type_sem_run.php?acttype=$acttype&&actyear=$actyear&&actsem=$actsem");
    }else {
        $errMSG = "พบข้อผิดพลาด";
    }
}
if (isset($_GET['actreg_id']) && ($_GET['acttype']) && ($_GET['actyear']) && ($_GET['actsem'])) {
    $acttype = $_GET['acttype'];
    $actyear = $_GET['actyear'];
    $actsem = $_GET['actsem'];
    $stmt_reg = $session->runQuery('UPDATE actregister 
                                   SET actregStatus="จำนงแก้กิจกรรม"
                                    WHERE actregNo=:actregno');
    $stmt_reg->bindParam(':actregno', $_GET['actreg_id']);
    if ($stmt_reg->execute()) {
?>
        <script>
            alert('ทำการจำนงแก้กิจกรรมสำเร็จ ...');
            window.location.href = '../view/student_activity_type_sem_run.php?acttype=$acttype&&actyear=$actyear&&actsem=$actsem';
        </script>
<?php
    } else {
        $errMSG = "พบข้อผิดพลาด";
    }
}
?>