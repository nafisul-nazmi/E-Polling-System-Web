<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$dname = $_POST['dname'];
	$dname = trim($dname);
	$sql = "insert into districts(dname) values ('$dname')";
	$conn->query($sql);
	$conn->close();
	header("Location: district.php");
?>