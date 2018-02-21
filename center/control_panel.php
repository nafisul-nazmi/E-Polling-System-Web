<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "agent") 
		header("Location: http://localhost/eps/login/view/agent_login.php");
	
?>

<!DOCTYPE html>

<html>

	<head>
		<title> Control Panel </title>
	</head>
	
	<body>
		
		<h3> Election Control Panel </h3>
		
		<p> Enter NID: <input type = "text" id = "nid" > </p>
		<div id = "status"> </div>
		<p> <button onclick = "check()"> Check status </button> </p>
		<br> <hr> <br>
		<button onclick = "block()"> Block this center </button>
		<p> <a href = "http://localhost/eps"> Go back </p>
		
		<script>
			function check() {
				var nid = document.getElementById("nid").value.trim();
				if(nid == "") {
					alert("Enter NID");
					return;
				}
					
				var xmlhttp = new XMLHttpRequest();
				var url = "checker.php?nid=" + nid;
				xmlhttp.onreadystatechange = function() {
	                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                    document.getElementById("status").innerHTML = xmlhttp.responseText;
	                }
	            }
	            xmlhttp.open("GET", url, true);
				xmlhttp.send();
			}
			function permit() {
				var nid = document.getElementById("nid").value.trim();
				if(nid == "") {
					alert("Enter NID");
					return;
				}
				var xmlhttp = new XMLHttpRequest();
				var url = "permit.php?nid=" + nid;
				xmlhttp.onreadystatechange = function() {
	                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                    document.getElementById("status").innerHTML = "";
						document.getElementById("nid").value = "";
	                }
	            }
	            xmlhttp.open("GET", url, true);
				xmlhttp.send();
			}
			function block() {
				var xmlhttp = new XMLHttpRequest();
				var url = "block.php";
				xmlhttp.onreadystatechange = function() {
	                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                    document.getElementById("status").innerHTML = "";
	                }
	            }
	            xmlhttp.open("GET", url, true);
				xmlhttp.send();
			}
			
		</script>
		
	</body>

</html>