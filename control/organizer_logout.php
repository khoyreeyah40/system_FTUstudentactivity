<?php
    require_once('session_organizer.php');
	require_once('class_organizer.php');
	$logout = new ORGANIZER();
	
	if($logout->is_loggedin()!="")
	{
		$logout->redirect('../view/organizer_homepage.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$logout->doLogout();
		$logout->redirect('../view/welcome_home.php');
	}