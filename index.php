<?php 
	session_start();
	if(isset($_SESSION['category'])) {
		if($_SESSION['category'] == "admin") 
			header("Location: http://localhost/eps/login/view/admin_panel.php");
		else if($_SESSION['category'] == "agent")
			header("Location: http://localhost/eps/login/view/agent_panel.php");
		else if($_SESSION['category'] == "voter")
			header("Location: http://localhost/eps/login/view/voter_panel.php");
			
	}
?>

<!DOCTYPE html>

<html>

	<head> 
		<title> E-Polling System </title>
	</head>
	
	<body>
	
		<h1> E-Polling System </h1>
		
		<p> <a href = "http://localhost/eps/login/view/admin_login.php"> Go to admin panel </p>
		<p> <a href = "http://localhost/eps/login/view/agent_login.php"> Go to agent panel </p>
		<p> <a href = "http://localhost/eps/login/view/voter_login.php"> Go to voting panel </p>
			
	</body>

</html>