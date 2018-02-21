<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$cnid = $_GET['cnid'];
	$sql = "delete from candidates where cnid = $cnid";
	$conn->query($sql);
	$conn->close();
	header("Location: candidate.php");
?>