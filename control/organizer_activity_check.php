<?php
if (isset($_GET['check_id'])&&($_GET['id'])) 
{
  $id=$_GET['id'];
  $stmt = $session->runQuery('UPDATE actregister 
                              SET actregStatus="ยืนยันเรียบร้อย"
                              WHERE actregNo=:actregno');
  $stmt->bindParam(':actregno', $_GET['check_id']);
  if($stmt->execute()){
  header("Location: ../view/organizer_activity_check.php?act_id=$id");
} else {
    $errMSG = "พบข้อผิดพลาด";
  }
}else
if (isset($_GET['checksolve_id'])&&($_GET['actsem'])&&($_GET['actmainorg'])&&($_GET['actorgtion'])&&($_GET['actsec'])&&($_GET['stdid'])&&($_GET['id'])) 
{
    $actsem = $_GET['actsem'];
    $actmainorg = $_GET['actmainorg'];
    $actorgtion = $_GET['actorgtion'];
    $actsec = $_GET['actsec'];
    $stdid = $_GET['stdid'];
    $id=$_GET['id'];
    $stmt = $session->runQuery('UPDATE actregister
                                INNER JOIN activity ON activity.actID = actregister.actregactID    
                                SET actregister.actregStatus="แก้กิจกรรมเรียบร้อย"
                                WHERE 
                                    activity.actSem=:actsem && activity.actSec=:actsec 
                                    && activity.actMainorg=:actmainorg && activity.actOrgtion=:actorgtion
                                    && actregister.actregstdID=:stdid && (actregister.actregStatus="จำนงแก้กิจกรรม"
                                    ||actregister.actregStatus="รอยืนยันการเข้าร่วม")');
    $stmt->bindParam(':actsem', $actsem);
    $stmt->bindParam(':actsec', $actsec);
    $stmt->bindParam(':actmainorg', $actmainorg);
    $stmt->bindParam(':actorgtion', $actorgtion);
    $stmt->bindParam(':stdid', $stdid);
    if($stmt->execute()){
    header("Location: ../view/organizer_activity_check.php?act_id=$id");
} else {
    $errMSG = "พบข้อผิดพลาด";
  }
}else
if (isset($_GET['actcancel'])&&($_GET['id'])) 
{
    $id=$_GET['id'];
    $stmt = $session->runQuery('UPDATE actregister 
                                SET actregStatus="รอยืนยันการเข้าร่วม"
                                WHERE actregNo=:actregno');
    $stmt->bindParam(':actregno', $_GET['actcancel']);
    if($stmt->execute()){ 
    header("Location: ../view/organizer_activity_check.php?act_id=$id");
} else {
    $errMSG = "พบข้อผิดพลาด";
  }
}else
if (isset($_GET['cancel2_id'])&&($_GET['actsem'])&&($_GET['actmainorg'])&&($_GET['actorgtion'])&&($_GET['actsec'])&&($_GET['stdid'])&&($_GET['id'])) {
    $actsem = $_GET['actsem'];
    $actmainorg = $_GET['actmainorg'];
    $actorgtion = $_GET['actorgtion'];
    $actsec = $_GET['actsec'];
    $stdid = $_GET['stdid'];
    $id=$_GET['id'];
    $stmt = $session->runQuery('UPDATE actregister
                                INNER JOIN activity ON activity.actID = actregister.actregactID    
                                SET actregister.actregStatus="จำนงแก้กิจกรรม"
                                WHERE 
                                    activity.actSem=:actsem && activity.actSec=:actsec 
                                    && activity.actMainorg=:actmainorg && activity.actOrgtion=:actorgtion
                                    && actregister.actregstdID=:stdid && actregister.actregStatus="แก้กิจกรรมเรียบร้อย"');
    $stmt->bindParam(':actsem', $actsem);
    $stmt->bindParam(':actsec', $actsec);
    $stmt->bindParam(':actmainorg', $actmainorg);
    $stmt->bindParam(':actorgtion', $actorgtion);
    $stmt->bindParam(':stdid', $stdid);
    if($stmt->execute()){
    header("Location: ../view/organizer_activity_check.php?act_id=$id");
} else {
    $errMSG = "พบข้อผิดพลาด";
  }
}
?>