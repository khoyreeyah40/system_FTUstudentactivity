<?php 
if (isset($_POST['btaddmainorg'])) {
    $mainorg = $_POST['mainorg'];
    $mainorgSec = $_POST['mainorgSec'];
    $mainorgAddby = $_POST['mainorgAddby'];
    if (empty($mainorg)) {
        $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }
    //check username
    if ($mainorg != "" && $mainorgSec != "") {
        $stmt = $session->runQuery("SELECT mainorg FROM mainorg WHERE mainorg='$mainorg' && mainorgSec='$mainorgSec'");
        $stmt->execute();
        if ($stmt->rowCount()) {
            $errMSG = "สังกัดนี้ได้ถูกเพิ่มแล้ว";
        }
    }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('INSERT INTO mainorg(mainorg,mainorgSec,mainorgAddby) VALUES
                                                        (:mainorg,:mainorgSec,:mainorgAddby)');
        $stmt->bindParam(':mainorg', $mainorg);
        $stmt->bindParam(':mainorgSec', $mainorgSec);
        $stmt->bindParam(':mainorgAddby', $mainorgAddby);
        if ($stmt->execute()) {
            $successMSG = "ทำการเพิ่มสำเร็จ";
            header("refresh:2; ../view/organizer_mainorganization.php");
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
if (isset($_GET['delete_id'])) {
  // it will delete an actual record from db
  $stmt = $session->runQuery('DELETE FROM mainorg WHERE mainorgNo =:mainorgno');
  $stmt->bindParam(':mainorgno', $_GET['delete_id']);
	if ($stmt->execute()) {
    $successMSG = "ทำการลบสำเร็จ";
    header("Location: ../view/organizer_mainorganization.php");
	} else {
		$errMSG = "ไม่สามารถทำการลบได้เนื่องข้อมูลถูกนำไปใช้แล้ว";
	}
}
?>