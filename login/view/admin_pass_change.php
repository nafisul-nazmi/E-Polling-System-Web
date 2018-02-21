<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "admin") {
		header("Location: http://localhost/eps/login/view/admin_login.php");
	}
?>

<!DOCTYPE html>

<html>

	<head>
		<title> Change Password </title>
	</head>
	
	<body>
		<h3> Change Password </h3>
		
		
		<form action = "http://localhost/eps/login/controller/admin_pass_change.php" method = "post" onsubmit = "return check()">
			<p> Old password: <input type = "password" name = "opassword" id = "opassword"> </p>
			<p> New password: <input type = "password" name = "npassword" id = "npassword"> </p>
			<p> Confirm new password: <input type = "password" name = "cpassword" id = "cpassword"> </p>
			<p> <input type = "submit" value = "Change"> </p>
		</form>
			
		
		<script>
			function check() {
				var opassword = document.getElementById("opassword").value;
				var npassword = document.getElementById("npassword").value;
				var cpassword = document.getElementById("cpassword").value;
				if(opassword == "" || cpassword == "" || npassword == "") {
					alert("Fields cannot be empty");
					return false;
				}
				else if(npassword != cpassword) {
					alert("Passwords do not match");
					return false;
				}
				return true;
			}
		</script>
		
	</body>

</html>