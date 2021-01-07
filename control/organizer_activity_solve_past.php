<?php
if (isset($_GET['actsolve_id'])) {

$stmt = $session->runQuery('UPDATE actregister 
                            SET actregStatus="แก้กิจกรรมเรียบร้อย"
                            WHERE actregNo=:actregno');
$stmt->bindParam(':actregno', $_GET['actsolve_id']);
if($stmt->execute()){

header("Location: organizer_activity_solve_past.php");
} else {
    $errMSG = "พบข้อผิดพลาด";
  }
}
?>