<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "voter") 
		header("Location: http://localhost/eps/login/view/voter_login.php");
	
?>

<!DOCTYPE html>

<html>

	<head>
		<title> Voting Panel </title>
	</head>
	
	<body>
		
		<h3> Welcome, Voter </h3>
		<p> <a href = 'http://localhost/eps/vote/vote_window.php'> Go to voting window </p>
		<p> <a href = 'http://localhost/eps/login/controller/logout.php'> Logout </p>
	
		
	</body>

</html>