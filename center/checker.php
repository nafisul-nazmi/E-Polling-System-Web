<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "agent") 
		header("Location: http://localhost/eps/login/view/agent_login.php");
	$cid = $_SESSION['cid'];
	$nid = "";
	if(isset($_GET['nid']))
		$nid = $_GET['nid'];
	
	$conn = new mysqli("localhost", "root", "", "eps");
	$sql = "select status from voters where cid = $cid and nid = $nid";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$conn->close();
	if($row == NULL) 
		echo "<p> Status: Voter does not belong to this center </p>";
	else if($row['status'] == 0) {
		echo "<p> Status: Voter did not vote, can be permitted </p>";
		echo "<button onClick = 'permit()'> Permit </button>";
	}
		
	else if($row['status'] == 1)
		echo "<p> Status: Voter already permitted, but did not vote </p>";
	else if($row['status'] == 2)
		echo "<p> Status: Voter already voted </p>";
	
		
?>