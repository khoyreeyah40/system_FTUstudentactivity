<?php
if (isset($_GET['actreg2_id']) && ($_GET['acttype']) && ($_GET['actyear'])) {
    $actid = $_GET['actreg2_id'];
    $acttype = $_GET['acttype'];
    $actyear = $_GET['actyear'];

    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('INSERT INTO actregister(actregactID,actregstdID,actregStatus) VALUES
                                                        (:actregactID,:actregstdID,"จำนงแก้กิจกรรม")');
        $stmt->bindParam(':actregactID', $actid);
        $stmt->bindParam(':actregstdID', $stdUser);
        if ($stmt->execute()) {
            $successMSG = "ทำการจำนงแก้กิจกรรมสำเร็จ";
            header("Location: ../view/student_activity_type_year_run.php?acttype=$acttype&&actyear=$actyear");
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
if (isset($_GET['actreg1_id']) && ($_GET['acttype']) && ($_GET['actyear'])) {
    $acttype = $_GET['acttype'];
    $actyear = $_GET['actyear'];
    // it will delete an actual record from db
    $stmt_delete = $session->runQuery('DELETE FROM actregister WHERE actregNo =:actregno');
    $stmt_delete->bindParam(':actregno', $_GET['actreg1_id']);
    if($stmt_delete->execute()){
        $successMSG = "ทำการลบสำเร็จ";
    header("Location: ../view/student_activity_type_year_run.php?acttype=$acttype&&actyear=$actyear");
} else {
    $errMSG = "พบข้อผิดพลาด";
}
}
if (isset($_GET['actreg_id']) && ($_GET['acttype']) && ($_GET['actyear'])) {
    $acttype = $_GET['acttype'];
    $actyear = $_GET['actyear'];
    $stmt_reg = $session->runQuery('UPDATE actregister 
                                   SET actregStatus="จำนงแก้กิจกรรม"
                                    WHERE actregNo=:actregno');
    $stmt_reg->bindParam(':actregno', $_GET['actreg_id']);
    if ($stmt_reg->execute()) {
?>
        <script>
            alert('ทำการจำนงแก้กิจกรรมสำเร็จ ...');
            window.location.href = '../view/student_activity_type_year_run.php?acttype=$acttype&&actyear=$actyear';
        </script>
<?php
    } else {
        $errMSG = "พบข้อผิดพลาด";
    }
}
?>