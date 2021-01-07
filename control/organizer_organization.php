<?php
if (isset($_POST['btaddorgtion'])) {
  $organization = $_POST['organization']; // user name
  $orgtionMainorg = $_POST['orgtionMainorg'];
  $orgtionAddby = $_POST['orgtionAddby'];

  if (empty($organization)) {
    $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
  }
  //check username
  if ($organization != "" && $orgtionMainorg != "") {

    $stmt = $session->runQuery("SELECT organization FROM organization WHERE organization='$organization' && orgtionMainorg='$orgtionMainorg'");
    $stmt->execute();
    if ($stmt->rowCount($checkexist)) {
      $errMSG = "องค์กรนี้ได้ถูกเพิ่มแล้ว";
    }
  }

  // if no error occured, continue ....
  if (!isset($errMSG)) {
    $stmt = $session->runQuery('INSERT INTO organization(organization,orgtionMainorg,orgtionAddby) VALUES
                                                        (:organization,:orgtionMainorg,:orgtionAddby)');
    $stmt->bindParam(':organization', $organization);
    $stmt->bindParam(':orgtionMainorg', $orgtionMainorg);
    $stmt->bindParam(':orgtionAddby', $orgtionAddby);
    if ($stmt->execute()) {
      $successMSG = "ทำการเพิ่มสำเร็จ";
      header("refresh:2;../view/organizer_organization.php");
    } else {
      $errMSG = "พบข้อผิดพลาด";
    }
  }
}
if (isset($_GET['delete_id'])) {
  // it will delete an actual record from db
  $stmt = $session->runQuery('DELETE FROM organization WHERE orgtionNo =:orgtionno');
  $stmt->bindParam(':orgtionno', $_GET['delete_id']);
  if ($stmt->execute()) {
    $successMSG = "ทำการลบสำเร็จ";
    header("Location: ../view/organizer_organization.php");
	} else {
		$errMSG = "ไม่สามารถทำการลบได้เนื่องข้อมูลถูกนำไปใช้แล้ว";
	}
}
?>