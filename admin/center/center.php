<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	
?>
<!DOCTYPE html>

<html>

	<head>
		<title> Centers </title>
	</head>
	
	</body>
	
		<?php
			$conn = new mysqli("localhost", "root", "", "eps");
			$sql = "select * from districts";
			$result = $conn->query($sql);
			$districts = array(array());
			$seats = array(array());
			$centers = array(array());
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$districts[$i]['dname'] = $row['dname'];
				$districts[$i]['did'] = $row['did'];
				$i++;
			}
			$sql = "select * from seats";
			$result = $conn->query($sql);
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$seats[$i]['sname'] = $row['sname'];
				$seats[$i]['sid'] = $row['sid'];
				$seats[$i]['did'] = $row['did'];
				$i++;
			}
			$sql = "select * from centers";
			$result = $conn->query($sql);
			$conn->close();
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$centers[$i]['cname'] = $row['cname'];
				$centers[$i]['sid'] = $row['sid'];
				$centers[$i]['cid'] = $row['cid'];
				$i++;
			}
				
		?>
		<h3> List of Centers </h3>
		<p> 
			Select district: 
			<select name = "district" id = "district" onChange = "change('district')"> <option> </option> </select> 
		</p>
		
		<p>
			Select seat:
			<select name = "seat" id = "seat" onChange = "load()"> <option> </option> </select>
		</p>
		
		
		<table width = "40%" id = "table">
			<tr>
				<td> <b> Center Name </b> </td>
			</tr>
		</table>
		
		<br> <hr> <br>
		<h3> Add new centers </h3>
		<form action = "add.php" method = "post" onSubmit = "return check()">
			<p> Select district: <select name = "district2" id = "district2" onChange = "change('district2')"> <option> </option> </select> </p>
			<p> Select seat: <select name = "seat2" id = "seat2"> <option> </option> </select> </p>
			<p> Center name: <input type = "text" id = "cname" name = "cname"> </p>
			<p> Password: <input type = "password" id = "password" name = "password"> </p>
			<p> Confirm password: <input type = "password" id = "cpassword" name = "cpassword"> </p>
			<p> <input type = "submit" value = "Add center"> </p>
		</form>
		
		<p> <a href = "http://localhost/eps"> Go back </p>
		
		<script>
			
			var districts = <?php echo json_encode($districts); ?>;
			var seats = <?php echo json_encode($seats); ?>;
			var centers = <?php echo json_encode($centers); ?>;
			var dname, did;
			

			for(var i = 0; i < districts.length; i++) {
				did = districts[i].did;
				dname = districts[i].dname;
				document.getElementById("district").innerHTML += "<option value = '" + did + "'>" + dname + "</option>";
				document.getElementById("district2").innerHTML += "<option value = '" + did + "'>" + dname + "</option>";
			}
		
			function check() {
				var cname = document.getElementById("cname").value.trim();
				var sid = document.getElementById("seat2").value;
				var password = document.getElementById("password").value;
				var cpassword = document.getElementById("cpassword").value;
				if(cname == "" || password == "" || cpassword == "" || sid == "") {
					alert("Fields cannot be empty");
					return false;
				}
				else if(password != cpassword) {
					alert("Passwords do not match");
					return false;
				}
				return true;
			}
			
			function change(id) {
				var did = document.getElementById(id).value;
				var sname, sid;
				if(id == "district")
					document.getElementById("seat").innerHTML = "<option> </option>";
				else if(id == "district2")
					document.getElementById("seat2").innerHTML = "<option> </option>";
				for(var i = 0; i < seats.length; i++) {
					if(seats[i].did == did) {
						sname = seats[i].sname;
						sid = seats[i].sid;
						if(id == "district") 
							document.getElementById("seat").innerHTML += "<option value = '" + sid + "'>" + sname + "</option>";
						
						else 
							document.getElementById("seat2").innerHTML += "<option value = '" + sid + "'>" + sname + "</option>";
						
					}
				}
			}
			
			function load() {
				var sid = document.getElementById("seat").value;
				document.getElementById("table").innerHTML = "<tr> <td> <b> Center Name </b> </td> </tr>";
				
				for(var i = 0; i < centers.length; i++) {
					if(centers[i].sid == sid) 
						document.getElementById("table").innerHTML += ("<tr> <td>" + centers[i].cname + "</td> <td> <a href = 'delete.php?cid=" + centers[i].cid + "'> Delete </td> </tr>");
				}
				
			}
		</script>
	
	</body>


</html>