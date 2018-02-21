<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$nid = trim($_POST['nid']);
	$cid = $_POST['center2'];
	$sql = "insert into voters(nid, cid, status) values ($nid, $cid, 0)";
	$conn->query($sql);
	$conn->close();
	header("Location: voter.php");
?>