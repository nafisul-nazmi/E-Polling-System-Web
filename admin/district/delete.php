<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$did = $_GET['did'];
	$sql = "delete from districts where did = $did";
	$conn->query($sql);
	$conn->close();
	header("Location: district.php");
?>