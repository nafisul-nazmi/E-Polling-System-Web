<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$cid = $_GET['cid'];
	$sql = "delete from centers where cid = $cid";
	$conn->query($sql);
	$conn->close();
	header("Location: center.php");
?>