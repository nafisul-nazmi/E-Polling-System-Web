<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	$conn = new mysqli("localhost", "root", "", "eps");
	$sql = "update teams set obtainedseats = 0";
	$conn->query($sql);
	$sql = "select sid from seats";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		$sql = "select max(obtainedvotes) from candidates where sid = {$row['sid']}";
		$result2 = $conn->query($sql);
		$maxvotes = $result2->fetch_assoc();
		$maxvotes = $maxvotes['max(obtainedvotes)'];
		if($maxvotes == 0)
			continue;
		$winnertid = 0;
		$counts = 0;
		$sql = "select tid from candidates where sid = {$row['sid']} and obtainedvotes = $maxvotes";
		$result2 = $conn->query($sql);
		//echo $sql;
		while($row2 = $result2->fetch_assoc()) {
			$winnertid = $row2['tid'];
			$counts++;
		}
		if($counts == 1) {
			$sql = "update teams set obtainedseats = obtainedseats + 1 where tid = $winnertid";
			$conn->query($sql);
		}
	}
	$conn->close();
	header("Location: http://localhost/eps");
	
?>