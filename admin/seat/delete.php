<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$sid = $_GET['sid'];
	$sql = "delete from seats where sid = $sid";
	$conn->query($sql);
	$conn->close();
	header("Location: seat.php");
?>