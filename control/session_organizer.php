<?php

session_start();

require_once 'class_organizer.php';
$session = new ORGANIZER();
$loginby = $_SESSION['orgzer_session'];
$stmt = $session->runQuery("SELECT organizer.*, usertype.*, mainorg.*, organization.* FROM organizer
									JOIN usertype ON organizer.orgzeruserType = usertype.usertypeID 
									JOIN mainorg ON organizer.orgzerMainorg = mainorg.mainorgNo
									JOIN organization ON organizer.orgzerOrgtion = organization.orgtionNo
									WHERE orgzerID=:orgzerID");
$stmt->execute(array(":orgzerID" => $loginby));
$orgzerRow = $stmt->fetch(PDO::FETCH_ASSOC);
// if user session is not active(not loggedin) this page will help 'home.php and profile.php' to redirect to login page
// put this file within secured pages that users (users can't access without login)

if (!$session->is_loggedin()) {
	// session no set redirects to login page
	$session->redirect('../view/welcome_home.php');
}
