<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$sql = "update centers set status = 1";
	$conn->query($sql);
	$conn->close();
	header("Location: http://localhost/eps");
?>