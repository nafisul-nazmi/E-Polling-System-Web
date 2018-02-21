<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "agent") 
		header("Location: http://localhost/eps/login/view/agent_login.php");
?>

<!DOCTYPE html>

<html>

	<head>
		<title> Agent Panel </title>
	</head>
	
	<body>
		
		<h3> Welcome, Agent </h3>
		
		<p> <a href = 'http://localhost/eps/center/control_panel.php'> Election Control Panel </p> 
		<p> <a href = 'http://localhost/eps/login/view/agent_pass_change.php'> Change Password </p>
		<p> <a href = 'http://localhost/eps/login/controller/logout.php'> Logout </p>
	
		
	</body>

</html>