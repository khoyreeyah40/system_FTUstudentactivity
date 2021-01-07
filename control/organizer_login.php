<?php
session_start();
require_once("class_organizer.php");
$login = new ORGANIZER();
if ($login->is_loggedin() != "")  //ล๊อกอินแล้วไปไหน
{
	$login->redirect('organizer_homepage.php');
}
if (isset($_POST['btlogin'])) {
	$orgzerID = strip_tags($_POST['orgzerID']);
	$orgzerPassword = strip_tags($_POST['orgzerPassword']);

	if ($login->doLogin($orgzerID, $orgzerPassword)) {
		$login->redirect('../view/organizer_homepage.php');
	} else {
		$error = "พบข้อผิดพลาดกรุณากรอกอีกครั้ง !";
	}
}

$orgzerID = $_POST['orgzerID'];
$orgzerPassword = $_POST['orgzerPassword'];
$stmt = $login->runQuery("SELECT * FROM organizer WHERE orgzerID='$orgzerID' and orgzerPassword = '$orgzerPassword'");
$stmt->execute();
$num_rows = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);
$loginby = $rowget['orgzerID'];
$loginname =$rowget['orgzerName'];
$mainorg =$rowget['orgzerMainorg'];
$orgtion =$rowget['orgzerOrgtion'];
$usertype =$rowget['orgzeruserType'];

if ($num_rows == 0) {
	// remove all session variables
	session_unset();
	header('Location: ../view/organizer_login.php');
	// destroy the session 
	session_destroy();
} else if ($num_rows == 1) {
	
	$stmt = $login->runQuery('INSERT INTO loginhistory (userID, userName, userMainorg, userOrgtion, userType, action)
							VALUES (:userID, :userName,:userMainorg,:userOrgtion,:userType,"login")');
	$stmt->bindParam(':userID', $loginby);
	$stmt->bindParam(':userName', $loginname);
	$stmt->bindParam(':userMainorg', $mainorg);
	$stmt->bindParam(':userOrgtion', $orgtion);
	$stmt->bindParam(':userType', $usertype);
	if ($stmt->execute()) {
		header('Location: ../view/organizer_homepage.php');
	} else {
		$errMSG = "เกิดข้อผิดพลาดกรุณาเข้าสู่ระบบอีกครั้ง";
	}
	
} else if ($num_rows <= 2) {
	echo "myproject Error 001" . $num_rows;
}
?>
