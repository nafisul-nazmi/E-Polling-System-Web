<?php	
	session_start();
	$username = "";
	$password = "";
	require_once('../model/Model.php');
	
	if(isset($_POST['username']) && isset($_POST['password'])) {
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);
	}
	
	$result = getCenters();

	while($row = $result->fetch_assoc()) {
		if($row['cid'] == $username && $row['password'] == $password) {
			$_SESSION['category'] = "agent";
			$_SESSION['cid'] = $row['cid'];
			$_SESSION['sid'] = $row['sid'];
			header("Location: http://localhost/eps/login/view/agent_panel.php");
		}
	}
	header("Location: http://localhost/eps/login/view/agent_login.php");
	
?>