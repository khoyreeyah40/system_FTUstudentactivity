<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT halaqahtc.*, organizer.*, mainorg.*, actyear.* FROM halaqahtc 
                                        JOIN organizer ON organizer.orgzerID = halaqahtc.halaqahtcID
                                        JOIN mainorg ON mainorg.mainorgNo = halaqahtc.halaqahtcMainorg
                                        JOIN actyear ON actyear.actyear = halaqahtc.halaqahtcYear 
                                        WHERE halaqahtcNo = :halaqahtcNo ');
    $stmt_update->execute(array(':halaqahtcNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_halaqah_teacher.php");
}
if (isset($_POST['btupdatehalaqahtc'])) {
    $halaqahtcYear = $_POST['halaqahtcYear'];
    $halaqahtcID = $_POST['halaqahtcID'];
    $halaqahtcMainorg = $_POST['halaqahtcMainorg'];


    if (empty($halaqahtcYear)) {
        $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }
    //check username
    if ($halaqahtcYear != "" && $halaqahtcID != "" && $halaqahtcMainorg != "") {

        $stmt = $session->runQuery("SELECT * FROM halaqahtc WHERE halaqahtcYear='$halaqahtcYear' && halaqahtcID='$halaqahtcID' && halaqahtcMainorg='$halaqahtcMainorg'");
        $checkexist = $stmt->execute();
        if ($stmt->rowCount($checkexist)) {


            $errMSG = "รายชื่อนี้ได้ถูกเพิ่มในปีการศึกษานี้แล้ว";
        }
    }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE halaqahtc
                                    SET 
                                    halaqahtcNo=:halaqahtcNo,
                                    halaqahtcYear=:halaqahtcYear,
                                    halaqahtcID=:halaqahtcID,
                                    halaqahtcMainorg=:halaqahtcMainorg
                                    WHERE halaqahtcNo=:halaqahtcNo');
        $stmt->bindParam(':halaqahtcNo', $halaqahtcNo);
        $stmt->bindParam(':halaqahtcYear', $halaqahtcYear);
        $stmt->bindParam(':halaqahtcID', $halaqahtcID);
        $stmt->bindParam(':halaqahtcMainorg', $halaqahtcMainorg);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_halaqah_teacher.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>