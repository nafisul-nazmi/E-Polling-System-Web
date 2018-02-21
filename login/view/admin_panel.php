<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "admin") 
		header("Location: http://localhost/eps/login/view/admin_login.php");
?>

<!DOCTYPE html>

<html>

	<head>
		<title> Admin Panel </title>
	</head>
	
	<body>
		
		<h3> Welcome, Admin </h3>
		
		<p> <a href = 'http://localhost/eps/admin/district/district.php'> District </p>
		<p> <a href = 'http://localhost/eps/admin/seat/seat.php'> Seat </p>
		<p> <a href = 'http://localhost/eps/admin/center/center.php'> Center </p>
		<p> <a href = 'http://localhost/eps/admin/voter/voter.php'> Voter </p>
		<p> <a href = 'http://localhost/eps/admin/team/team.php'> Team </p>
		<p> <a href = 'http://localhost/eps/admin/candidate/candidate.php'> Candidate </p>
		<p> <a href = 'http://localhost/eps/admin/blocked_center/blocked_center.php'> Blocked Centers </p>
		<p> <a href = 'http://localhost/eps/admin/election/start_election.php'> Start Election </p>
		<p> <a href = 'http://localhost/eps/admin/election/end_election.php'> End Election </p>
		<p> <a href = 'http://localhost/eps/admin/election/generate_result.php'> Generate Result </p>
		<p> <a href = 'http://localhost/eps/login/view/admin_pass_change.php'> Change Password </p>
		<p> <a href = 'http://localhost/eps/login/controller/logout.php'> Logout </p>
	
		
	</body>

</html>