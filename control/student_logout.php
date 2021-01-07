<?php
	require_once('session_student.php');
	require_once('class_student.php');
	$logout = new STUDENT();
	
	if($logout->is_loggedin()!="")
	{
		$logout->redirect('../view/student_homepage.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$logout->doLogout();
		$logout->redirect('../view/welcome_home.php');
	}