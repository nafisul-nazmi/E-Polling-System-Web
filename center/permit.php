<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "agent") 
		header("Location: http://localhost/eps/login/view/agent_login.php");
	$cid = $_SESSION['cid'];
	$nid = "";
	if(isset($_GET['nid']))
		$nid = $_GET['nid'];
	
	$conn = new mysqli("localhost", "root", "", "eps");
	$sql = "update voters set status = 1 where cid = $cid and nid = $nid";
	$conn->query($sql);
	$conn->close();
?>