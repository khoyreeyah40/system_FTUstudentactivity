<?php
if (isset($_GET['actopen_id'])) {

$stmt = $session->runQuery('UPDATE activity 
                               SET actStatus="เปิดการลงทะเบียน"
                                WHERE actNo=:actno');
$stmt->bindParam(':actno', $_GET['actopen_id']);
if($stmt->execute()){
header("Location: ../view/organizer_activity_active.php");
} else {
  $errMSG = "พบข้อผิดพลาด";
}
}
if (isset($_GET['actopen1_id'])) {

$stmt = $session->runQuery('UPDATE activity 
                               SET actStatus="เปิดการลงทะเบียน"
                                WHERE actNo=:actno');
$stmt ->bindParam(':actno', $_GET['actopen1_id']);
if($stmt ->execute()){
header("Location: ../view/organizer_activity_active.php");
} else {
  $errMSG = "พบข้อผิดพลาด";
}
}
if (isset($_GET['actclose_id'])) {

$stmt = $session->runQuery('UPDATE activity 
                               SET actStatus="ปิดการลงทะเบียน"
                                WHERE actNo=:actno');
$stmt->bindParam(':actno', $_GET['actclose_id']);
if($stmt->execute()){
header("Location: ../view/organizer_activity_active.php");
} else {
  $errMSG = "พบข้อผิดพลาด";
}
}
if (isset($_GET['actagain_id'])) {

$stmt = $session->runQuery('UPDATE activity 
                               SET actStatus="ดำเนินกิจกรรม"
                                WHERE actNo=:actno');
$stmt->bindParam(':actno', $_GET['actagain_id']);
if($stmt ->execute()){

header("Location: ../view/organizer_activity_active.php");
} else {
  $errMSG = "พบข้อผิดพลาด";
}
}
if (isset($_GET['actagain1_id'])) {

$stmt = $session->runQuery('UPDATE activity 
                               SET actStatus="กิจกรรมเสร็จสิ้น"
                                WHERE actNo=:actno');
$stmt->bindParam(':actno', $_GET['actagain1_id']);
if($stmt ->execute()){

header("Location: ../view/organizer_activity_active.php");
} else {
  $errMSG = "พบข้อผิดพลาด";
}
}
if (isset($_GET['actfinish_id'])) {

$stmt = $session->runQuery('UPDATE activity 
                               SET actStatus="กิจกรรมเสร็จสิ้น"
                                WHERE actNo=:actno');
$stmt->bindParam(':actno', $_GET['actfinish_id']);
if($stmt ->execute()){

header("Location: ../view/organizer_activity_active.php");
} else {
  $errMSG = "พบข้อผิดพลาด";
}
}
if (isset($_GET['delete_id'])) {
// it will delete an actual record from db
if (!isset($errMSG)) {  
$stmt = $session->runQuery('DELETE FROM activity WHERE actNo =:actno');
$stmt->bindParam(':actno', $_GET['delete_id']);
if($stmt->execute()){
header("Location: ../view/organizer_activity_active.php");
}
  else {
      $errMSG = "ไม่สามารถลบได้";
  }
}
}
?>