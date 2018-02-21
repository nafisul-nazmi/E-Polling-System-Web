<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "agent") {
		header("Location: http://localhost/eps/login/view/agent_login.php");
	}
	$cid = $_SESSION['cid'];
	$opassword = "";
	$npassword = "";
	require_once('../model/Model.php');
	
	if(isset($_POST['opassword']) && isset($_POST['npassword'])) {
	
		$opassword = md5($_POST['opassword']);
		$npassword = md5($_POST['npassword']);
		
	}
	
	$result = getCenters();

	while($row = $result->fetch_assoc()) {
		if($row['cid'] == $cid && $row['password'] == $opassword) {
			
			changeCenterPass($cid, $npassword);
			break;
		}
	}
	header("Location: http://localhost/eps/login/view/agent_panel.php");
	
?>



