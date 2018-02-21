<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	
?>
<!DOCTYPE html>

<html>

	<head>
		<title> Districts </title>
	</head>
	
	</body>
	
		<h3> List of Districts </h3>
		
		<table width = "25%">
			<tr>
				<td> <b> District </b> </td>
			</tr>
			
			<?php
				
				$conn = new mysqli("localhost", "root", "", "eps");
				$sql = "select * from districts";
				$result = $conn->query($sql);
				$conn->close();
				while($row = $result->fetch_assoc()) {
					$dname = $row['dname'];
					$did = $row['did'];
					echo "<tr>";
					echo "<td> $dname </td>";
					echo "<td> <a href = 'delete.php?did=$did'> Delete </td>";
					echo "</tr>";
					
				}
				
				
			?>
		</table>
		
		<br> <hr> <br>
		<h3> Add new districts </h3>
		<form action = "add.php" method = "post" onSubmit = "return check()">
		
			<p> District Name: <input type = "text" name = "dname" id = "dname" value = ""> </p>
			<p> <input type = "submit" value = "Add district"> </p>
		
		</form>
		
		<p> <a href = "http://localhost/eps"> Go back </p>
		
		<script>
			function check() {
				var dname = document.getElementById('dname').value;
				dname.trim();
				if(dname == "") {
					window.alert("District name cannot be empty");
					return false;
				}
				else
					return true;
			}
		</script>
	
	</body>


</html>