<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
?>
<!DOCTYPE html>

<html>

	<head>
		<title> Voters </title>
	</head>
	
	</body>
	
		<?php
			$conn = new mysqli("localhost", "root", "", "eps");
			$sql = "select * from districts";
			$result = $conn->query($sql);
			$districts = array(array());
			$seats = array(array());
			$centers = array(array());
			$voters = array(array());
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
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$centers[$i]['cname'] = $row['cname'];
				$centers[$i]['sid'] = $row['sid'];
				$centers[$i]['cid'] = $row['cid'];
				$i++;
			}
			$sql = "select * from voters";
			$result = $conn->query($sql);
			$conn->close();
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$voters[$i]['nid'] = $row['nid'];
				$voters[$i]['status'] = $row['status'];
				$voters[$i]['cid'] = $row['cid'];
				$i++;
			}
				
		?>
		<h3> List of Voters </h3>
		<p> 
			Select district: 
			<select name = "district" id = "district" onChange = "change_district('district')"> <option> </option> </select> 
		</p>
		
		<p>
			Select seat:
			<select name = "seat" id = "seat" onChange = "change_seat('seat')"> <option> </option> </select>
		</p>
		
		<p>
			Select center:
			<select name = "center" id = "center" onChange = "load()"> <option> </option> </select>
		</p>
		
		
		<table width = "40%" id = "table">
			<tr>
				<td> <b> NID </b> </td>
				<td> <b> Status </b> </td>
			</tr>
		</table>
		
		<br> <hr> <br>
		<h3> Add new centers </h3>
		<form action = "add.php" method = "post" onSubmit = "return check()">
			<p> Select district: <select name = "district2" id = "district2" onChange = "change_district('district2')"> <option> </option> </select> </p>
			<p> Select seat: <select name = "seat2" id = "seat2" onChange = "change_seat('seat2')"> <option> </option> </select> </p>
			<p> Select center: <select name = "center2" id = "center2"> <option> </option> </select> </p>
			<p> NID: <input type = "text" id = "nid" name = "nid"> </p>
			<p> <input type = "submit" value = "Add voter"> </p>
		</form>
		
		<p> <a href = "http://localhost/eps"> Go back </p>
		
		<script>
			
			var districts = <?php echo json_encode($districts); ?>;
			var seats = <?php echo json_encode($seats); ?>;
			var centers = <?php echo json_encode($centers); ?>;
			var voters = <?php echo json_encode($voters); ?>;
			var dname;
			

			for(var i = 0; i < districts.length; i++) {
				dname = districts[i].dname;
				did = districts[i].did;
				document.getElementById("district").innerHTML += "<option value = '" + did + "'>" + dname + "</option>";
				document.getElementById("district2").innerHTML += "<option value = '" + did + "'>" + dname + "</option>";
			}
		
			function check() {
				var nid = document.getElementById("nid").value.trim();
				var cid = document.getElementById("center2").value;
				if(nid == "" || cid == "") {
					alert("Fields cannot be empty");
					return false;
				}
				return true;
			}
			
			function change_seat(id) {
				var sid = document.getElementById(id).value;
				var cname, cid;
				if(id == "seat")
					document.getElementById("center").innerHTML = "<option> </option>";
				else
					document.getElementById("center2").innerHTML = "<option> </option>";
				for(var i = 0; i < centers.length; i++) {
					if(centers[i].sid == sid) {
						cname = centers[i].cname;
						cid = centers[i].cid;
						if(id == "seat") 
							document.getElementById("center").innerHTML += "<option value = '" + cid + "'>" + cname + "</option>";
						
						else 
							document.getElementById("center2").innerHTML += "<option value = '" + cid + "'>" + cname + "</option>";
						
					}
				}
			}
			
			function change_district(id) {
				var did = document.getElementById(id).value;
				var sid, sname;
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
				var cid = document.getElementById("center").value;
				document.getElementById("table").innerHTML = "<tr> <td> <b> NID </b> </td> <td> <b> Status </b> </td> </tr>";
				
				for(var i = 0; i < voters.length; i++) {
					if(voters[i].cid == cid) 
						document.getElementById("table").innerHTML += ("<tr> <td>" + voters[i].nid + "</td> <td>" + voters[i].status + "</td> <td> <a href = 'delete.php?nid=" + voters[i].nid + "'> Delete </td> </tr>");
				}
				
			}
		</script>
	
	</body>


</html>