<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
?>
<!DOCTYPE html>

<html>

	<head>
		<title> Seats </title>
	</head>
	
	</body>
	
		<h3> List of Seats </h3>
		
		<table width = "40%">
			<tr>
				<td> <b> Seat </b> </td>
				<td> <b> District </b> </td>
			</tr>
			
			<?php
				
				$conn = new mysqli("localhost", "root", "", "eps");
				$sql = "select * from seats";
				$result = $conn->query($sql);
				$sql = "select * from districts";
				$result2 = $conn->query($sql);
				$districts = array(array());
				$i = 0;
				while($row = $result2->fetch_assoc()) {
					$districts[$i]['dname'] = $row['dname'];
					$districts[$i]['did'] = $row['did'];
					$i++;
				}
				
				$conn->close();
				while($row = $result->fetch_assoc()) {
					$sname = $row['sname'];
					$sid = $row['sid'];
					$did = $row['did'];
					for($i = 0; $i < count($districts); $i++) {
						if($did == $districts[$i]['did']) {
							$dname = $districts[$i]['dname'];
							break;
						}
					}
					
					echo "<tr>";
					echo "<td> $sname </td>";
					echo "<td> $dname </td>";
					echo "<td> <a href = 'delete.php?sid=$sid'> Delete </td>";
					echo "</tr>";
					
				}
				
				
			?>
		</table>
		
		<br> <hr> <br>
		<h3> Add new seats </h3>
		<form action = "add.php" method = "post" onSubmit = "return check()">
			<p> Seat Name: <input type = "text" name = "sname" id = "sname"> </p>
			<p> 
				District Name:
				<select name = 'did'>
					<?php  
						for($i = 0; $i < count($districts); $i++) 
							echo "<option value = {$districts[$i]['did']}> {$districts[$i]['dname']} </option>";
					?>
				</select>
			</p>
			<p> <input type = "submit" value = "Add seat"> </p>
		
		</form>
		
		<p> <a href = "http://localhost/eps"> Go back </p>
		
		<script>
			function check() {
				var sname = document.getElementById('sname').value;
				sname.trim();
				if(sname == "") {
					window.alert("Seat name cannot be empty");
					return false;
				}
				else
					return true;
			}
		</script>
	
	</body>


</html>