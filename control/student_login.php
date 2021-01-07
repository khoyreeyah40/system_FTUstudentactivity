<?php
session_start();
require_once("class_student.php");
$login = new STUDENT();

if ($login->is_loggedin() != "")  //ล๊อกอินแล้วไปไหน
{
	$login->redirect('../view/student_homepage.php');
}

if (isset($_POST['btlogin'])) {
	$stdID = strip_tags($_POST['stdID']);
	$stdPassword = strip_tags($_POST['stdPassword']);

	if ($login->doLogin($stdID, $stdPassword)) {
		$login->redirect('../view/student_homepage.php');
	} else {
		$error = "พบข้อผิดพลาดกรุณากรอกอีกครั้ง !";
	}
}

$stdID = $_POST['stdID'];
$stdPassword = $_POST['stdPassword'];
$stmt = $login->runQuery("SELECT * FROM student WHERE stdID='$stdID' and stdPassword = '$stdPassword'");
$stmt->execute();
$num_rows = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);
$loginby = $rowget['stdID'];
$loginname =$rowget['stdName'];
$mainorg =$rowget['stdMainorg'];
$orgtion =$rowget['stdOrgtion'];

if ($num_rows == 0) {
	// remove all session variables
	session_unset();
	header('Location: ../view/student_login.php');
	// destroy the session 
	session_destroy();
} else if ($num_rows == 1) {
	
	$stmt = $login->runQuery('INSERT INTO loginhistory (userID, userName, userMainorg, userOrgtion, userType, action)
							VALUES (:userID, :userName,:userMainorg,:userOrgtion,"student","login")');
	$stmt->bindParam(':userID', $loginby);
	$stmt->bindParam(':userName', $loginname);
	$stmt->bindParam(':userMainorg', $mainorg);
	$stmt->bindParam(':userOrgtion', $orgtion);
	if ($stmt->execute()) {
		header('Location: ../view/student_homepage.php');
	} else {
		$errMSG = "เกิดข้อผิดพลาดกรุณาเข้าสู่ระบบอีกครั้ง";
	}
	
} else if ($num_rows <= 2) {
	echo "myproject Error 001" . $num_rows;
}
?>
