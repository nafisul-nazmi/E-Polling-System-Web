<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "voter") {
		header("Location: http://localhost/eps/login/view/voter_login.php");
	}
	$cid = $_SESSION['cid'];
	$nid = 0;
	$cnid = 0;
	if(isset($_GET['cnid']))
		$cnid = $_GET['cnid'];
	if(isset($_GET['nid']))
		$nid = $_GET['nid'];
	$conn = new mysqli("localhost", "root", "", "eps");
	$sql = "select status from voters where nid = $nid and cid = $cid";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if($row == NULL)
		echo "Invalid NID";
	else {
		if($row['status'] != 1)
			echo "You do not have permission";
		else {
			$sql = "select status from centers where cid = $cid";
			$result = $conn->query($sql);
			$row2 = $result->fetch_assoc();
			if($row2['status'] == 0)
				echo "Election is got going on right now";
			else if($row2['status'] == 2)
				echo "Center is blocked";
			else {
				$sql = "update voters set status = 2 where nid = $nid";
				$conn->query($sql);
				$sql = "update candidates set obtainedvotes = obtainedvotes + 1 where cnid = $cnid";
				$conn->query($sql);
				echo "Your vote has been counted";
			}
		}
	}
?>