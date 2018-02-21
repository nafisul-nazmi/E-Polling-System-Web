<?php	
	session_start();
	$username = "";
	$password = "";
	require_once('../model/Model.php');
	
	if(isset($_POST['username']) && isset($_POST['password'])) {
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);
	}
	
	$result = getAdmins();

	while($row = $result->fetch_assoc()) {
		if($row['username'] == $username && $row['password'] == $password) {
			$_SESSION['category'] = "admin";
			header("Location: http://localhost/eps/login/view/admin_panel.php");
		}
	}
	header("Location: http://localhost/eps/login/view/admin_login.php");
	
?>