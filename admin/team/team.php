<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
?>
<!DOCTYPE html>

<html>

	<head>
		<title> Teams </title>
	</head>
	
	</body>
	
		<h3> List of Teams </h3>
		
		<table width = "50%">
			<tr>
				<td> <b> Team Name </b> </td>
				<td> <b> Symbol </b> </td>
				<td> <b> Obtained Seats </b> </td>
			</tr>
			
			<?php
				
				$conn = new mysqli("localhost", "root", "", "eps");
				$sql = "select * from teams";
				$result = $conn->query($sql);
				$conn->close();
				while($row = $result->fetch_assoc()) {
					$tname = $row['tname'];
					$tid = $row['tid'];
					$obtainedseats = $row['obtainedseats'];
					$symbol = $row['symbol'];
					echo "<tr>";
					echo "<td> $tname </td>";
					echo "<td> <img src = 'symbols/$symbol' width = '100' height = '100'> </td>";
					echo "<td> $obtainedseats </td>";
					echo "<td> <a href = 'delete.php?tid=$tid'> Delete </td>";
					echo "</tr>";
					
				}
				
				
			?>
		</table>
		
		<br> <hr> <br>
		<h3> Add new teams </h3>
		<form action = "add.php" method = "post" enctype = "multipart/form-data" onSubmit = "return check()">
		
			<p> Team Name: <input type = "text" name = "tname" id = "tname"> </p>
			<p> Symbol: <input type = "file" name = "image" id = "image"> </p>
			<p> <input type = "submit" value = "Add team"> </p>
		
		</form>
		
		<p> <a href = "http://localhost/eps"> Go back </p>
		
		<script>
			function check() {
				var tname = document.getElementById('tname').value.trim();
				var img = document.getElementById('image').value;
				if(tname == "" || img == "") {
					window.alert("Enter team name and upload a symbol");
					return false;
				}
				else
					return true;
			}
		</script>
	
	</body>


</html>