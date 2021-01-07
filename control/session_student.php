<?php

session_start();

require_once 'class_student.php';
$session = new STUDENT();
$stdUser = $_SESSION['std_session'];

$stmt = $session->runQuery("SELECT student.*,organization.*, teacher.*, mainorg.* FROM student 
							JOIN organization ON organization.orgtionNo = student.stdOrgtion
							JOIN teacher ON teacher.teacherNo = student.stdTc
							JOIN mainorg ON mainorg.mainorgNo = student.stdMainorg
							WHERE student.stdID=:stdID");
$stmt->execute(array(":stdID" => $stdUser));
$stdRow = $stmt->fetch(PDO::FETCH_ASSOC);
// if user session is not active(not loggedin) this page will help 'home.php and profile.php' to redirect to login page
// put this file within secured pages that users (users can't access without login)

if (!$session->is_loggedin()) {
	// session no set redirects to login page
	$session->redirect('../view/welcome_home.php');
}
