<?php
if (isset($_POST['btconfirmhalaqah'])) {
    $confirm_id = $_POST['confirm_id'];
    $halaqahcheckstdID = $_POST['halaqahcheckstd_id'];
    $halaqahchecklist_no = $_POST['halaqahchecklist_no'];
    if ($confirm_id == $halaqahchecklist_no) {
        //check username
        if ($halaqahchecklist_no != "" && $halaqahcheckstdID != "") {

            $stmt = $session->runQuery("SELECT * FROM halaqahcheck WHERE halaqahchecklistNo='$halaqahchecklist_no' && halaqahcheckstdID='$halaqahcheckstdID'");
            $stmt->execute();
            if ($stmt->rowCount()) {
                $errMSG = "รายชื่อนี้ได้ถูกเพิ่มแล้ว";
            }
        }

        // if no error occured, continue ....
        if (!isset($errMSG)) {
            $stmt = $session->runQuery('INSERT INTO halaqahcheck(halaqahchecklistNo,halaqahcheckstdID) VALUES
                                                          (:halaqahchecklistNo, :halaqahcheckstdID)');
            $stmt->bindParam(':halaqahchecklistNo', $halaqahchecklist_no);
            $stmt->bindParam(':halaqahcheckstdID', $halaqahcheckstdID);
            if ($stmt->execute()) {
                $successMSG = "ทำการเพิ่มสำเร็จ";
                header("refresh:2;../view/student_activity_confirm.php");
            } else {
                $errMSG = "พบข้อผิดพลาด";
            }
        }
    } else {
        $errMSG = "รหัสไม่ตรงกันกรุณากรอกใหม่อีกครั้ง";
    }
}
if (isset($_GET['delete_id'])) {
    // it will delete an actual record from db
    $stmt_delete = $session->runQuery('DELETE FROM actregister WHERE actregNo =:actregno');
    $stmt_delete->bindParam(':actregno', $_GET['delete_id']);
    $stmt_delete->execute();

    header("Location:  ../view/student_activity_confirm.php");
}
if (isset($_POST['btconfirm'])) {
    $confirm_id = $_POST['confirm_id'];
    $check_id = $_POST['check_id'];
    $act_id = $_POST['act_id'];
    if ($confirm_id == $act_id) {
        $stmt_check = $session->runQuery('UPDATE actregister 
                                   SET actregStatus="ยืนยันเรียบร้อย"
                                    WHERE actregNo=:actregno');
        $stmt_check->bindParam(':actregno', $check_id);
        if ($stmt_check->execute()) {
?>
            <script>
                alert('ทำการยืนยันเรียบร้อย ...');
                window.location.href = '../view/student_activity_confirm.php';
            </script>
        <?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    } else {
        $errMSG = "รหัสไม่ตรงกันกรุณากรอกใหม่อีกครั้ง";
    }
}
if (isset($_POST['btconfirmsolve'])) {
    $confirm_id = $_POST['confirm_id'];
    $checksolve_id = $_POST['checksolve_id'];
    $act_id = $_POST['act_id'];
    $actsem = $_POST['actsem'];
    $actmainorg = $_POST['actmainorg'];
    $actorgtion = $_POST['actorgtion'];
    $actsec = $_POST['actsec'];
    $stdid = $_POST['stdid'];
    if ($confirm_id == $act_id) {
        $stmt = $session->runQuery('UPDATE actregister
                                  INNER JOIN activity ON activity.actID = actregister.actregactID    
                                  SET actregister.actregStatus="แก้กิจกรรมเรียบร้อย"
                                  WHERE activity.actSem=:actsem && activity.actSec=:actsec 
                                    && activity.actMainorg=:actmainorg && activity.actOrgtion=:actorgtion
                                    && actregister.actregstdID=:stdid && (actregister.actregStatus="จำนงแก้กิจกรรม"||actregister.actregStatus="รอยืนยันการเข้าร่วม")');
        $stmt->bindParam(':actsem', $actsem);
        $stmt->bindParam(':actsec', $actsec);
        $stmt->bindParam(':actmainorg', $actmainorg);
        $stmt->bindParam(':actorgtion', $actorgtion);
        $stmt->bindParam(':stdid', $stdid);
        if ($stmt_check->execute()) {
        ?>
            <script>
                alert('ทำการยืนยันเรียบร้อย ...');
                window.location.href = '../view/student_activity_confirm.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    } else {
        $errMSG = "รหัสไม่ตรงกันกรุณากรอกใหม่อีกครั้ง";
    }
}


?>