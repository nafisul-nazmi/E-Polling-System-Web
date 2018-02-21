<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$sname = $_POST['sname'];
	$did = $_POST['did'];
	$sname = trim($sname);
	$sql = "insert into seats(sname, did) values ('$sname', $did)";
	$conn->query($sql);
	$conn->close();
	header("Location: seat.php");
?>