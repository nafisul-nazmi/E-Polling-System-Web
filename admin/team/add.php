<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$tname = trim($_POST['tname']);
	$filedir = "symbols/";
	$filename = basename($_FILES['image']['name']);
	$img = $_FILES['image']['tmp_name'];
	move_uploaded_file($img, $filedir.$filename);
	$sql = "insert into teams(tname, symbol, obtainedseats) values('$tname', '$filename', 0)";
	$conn->query($sql);
	$conn->close();
	header("Location: team.php");
?>