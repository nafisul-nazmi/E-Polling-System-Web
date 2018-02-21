<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$cid = $_GET['cid'];
	$sql = "update centers set status = 1 where cid = $cid";
	$conn->query($sql);
	$conn->close();
	header("Location: blocked_center.php");
?>