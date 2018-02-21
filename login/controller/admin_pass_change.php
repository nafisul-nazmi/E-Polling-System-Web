<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "admin") {
		header("Location: http://localhost/eps/login/view/admin_login.php");
	}
	
	$opassword = "";
	$npassword = "";
	require_once('../model/Model.php');
	
	if(isset($_POST['opassword']) && isset($_POST['npassword'])) {
	
		$opassword = md5($_POST['opassword']);
		$npassword = md5($_POST['npassword']);
		
	}
	
	$result = getAdmins();

	while($row = $result->fetch_assoc()) {
		if($row['username'] == "admin" && $row['password'] == $opassword) {
			
			changeAdminPass('admin', $npassword);
			break;
		}
	}
	header("Location: http://localhost/eps/login/view/admin_panel.php");
	
?>



