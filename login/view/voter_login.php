<?php
	session_start();
	if(isset($_SESSION["category"])) {
		if($_SESSION["category"] == "voter")
			header("Location: http://localhost/eps/login/view/voter_panel.php");
	}
?>

<!DOCTYPE html>

<html>

	<head>
		<title> Voting Panel Login </title>
	</head>
	
	<body>
		<h3> Login at Voting Panel </h3>
		
		
		<form action = "http://localhost/eps/login/controller/voter_controller.php" method = "post" onsubmit = "return check()">
			<p> User Name: <input type = "text" name = "username" id = "username"> </p>
			<p> Password: <input type = "password" name = "password" id = "password"> </p>
			<p> <input type = "submit" value = "Login"> </p>
		</form>
			
		
		<script>
			function check() {
				var username = document.getElementById("username").value.trim();
				var password = document.getElementById("password").value;
				if(username == "" || password == "") {
					alert("Fields cannot be empty");
					return false;
				}
				return true;
			}
		</script>
		
	</body>

</html>