<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$cname = trim($_POST['cname']);
	$sid = $_POST['seat2'];
	$tid = $_POST['team'];
	$sql = "insert into candidates(cname, sid, tid, obtainedvotes) values ('$cname', $sid, $tid, 0)";
	$conn->query($sql);

	$conn->close();
	header("Location: candidate.php");
?>