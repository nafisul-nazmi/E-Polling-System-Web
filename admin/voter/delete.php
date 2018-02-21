<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$nid = $_GET['nid'];
	$sql = "delete from voters where nid = $nid";
	$conn->query($sql);
	$conn->close();
	header("Location: voter.php");
?>