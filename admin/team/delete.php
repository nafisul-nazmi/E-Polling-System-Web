<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$tid = $_GET['tid'];
	$sql = "delete from teams where tid = $tid";
	$conn->query($sql);
	$conn->close();
	header("Location: team.php");
?>