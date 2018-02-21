<?php 
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "agent") 
		header("Location: http://localhost/eps/login/view/agent_login.php");
	$cid = $_SESSION['cid'];
	$conn = new mysqli("localhost", "root", "", "eps");
	$sql = "select status from centers where cid = $cid";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if($row['status'] == 1) {
		$sql = "update centers set status = 2 where cid = $cid";
		$conn->query($sql);
		$conn->close();
	}
	
?>