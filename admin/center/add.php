<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$cname = trim($_POST['cname']);
	$sid = $_POST['seat2'];
	$password = md5($_POST['password']);

	$sql = "insert into centers(cname, sid, status, password) values ('$cname', $sid, 0, '$password')";
	$conn->query($sql);

	$conn->close();
	header("Location: center.php");
?>