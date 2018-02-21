<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
?>
<!DOCTYPE html>

<html>

	<head>
		<title> Candidates </title>
	</head>
	
	</body>
	
		<?php		
			$conn = new mysqli("localhost", "root", "", "eps");
			$sql = "select * from districts";
			$result = $conn->query($sql);
			$districts = array(array());
			$seats = array(array());
			$teams = array(array());
			$candidates = array(array());
			$images = array();
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
			$sql = "select * from teams";
			$result = $conn->query($sql);
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$teams[$i]['tname'] = $row['tname'];
				$teams[$i]['tid'] = $row['tid'];
				$teams[$i]['symbol'] = $row['symbol'];
				$i++;
			}
			$sql = "select * from candidates";
			$result = $conn->query($sql);
			$conn->close();
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$candidates[$i]['cname'] = $row['cname'];
				$candidates[$i]['cnid'] = $row['cnid'];
				$candidates[$i]['sid'] = $row['sid'];
				$candidates[$i]['tid'] = $row['tid'];
				$candidates[$i]['obtainedvotes'] = $row['obtainedvotes'];
				$i++;
			}
				
		?>
		<h3> List of Candidates </h3>
		<p> 
			Select district: 
			<select name = "district" id = "district" onChange = "change('district')"> <option> </option> </select> 
		</p>
		
		<p>
			Select seat:
			<select name = "seat" id = "seat" onChange = "load()"> <option> </option> </select>
		</p>
		
		
		<table width = "50%" id = "table">
			<tr>
				<td> <b> Candidate Name </b> </td>
				<td> <b> Team Name </b> </td>
				<td> <b> Symbol </b> </td>
				<td> <b> Obtained Votes </b> </td>
				
			</tr>
		</table>
		
		<br> <hr> <br>
		<h3> Add new candidates </h3>
		<form action = "add.php" method = "post" onSubmit = "return check()">
			<p> Select district: <select name = "district2" id = "district2" onChange = "change('district2')"> <option> </option> </select> </p>
			<p> Select seat: <select name = "seat2" id = "seat2"> <option> </option> </select> </p>
			<p> Select team: <select name = "team" id = "team"> <option> </option> </select> </p>
			<p> Candidate Name: <input type = "text" id = "cname" name = "cname"> </p>
			<p> <input type = "submit" value = "Add candidate"> </p>
		</form>
		
		<p> <a href = "http://localhost/eps"> Go back </p>
		
		<script>
			
			var districts = <?php echo json_encode($districts); ?>;
			var seats = <?php echo json_encode($seats); ?>;
			var teams = <?php echo json_encode($teams); ?>;
			var candidates = <?php echo json_encode($candidates); ?>;
			var images = <?php echo json_encode($images); ?>;
			var dname, did;
			

			for(var i = 0; i < districts.length; i++) {
				did = districts[i].did;
				dname = districts[i].dname;
				document.getElementById("district").innerHTML += "<option value = '" + did + "'>" + dname + "</option>";
				document.getElementById("district2").innerHTML += "<option value = '" + did + "'>" + dname + "</option>";
			}
			
			for(var i = 0; i < teams.length; i++) {
				tid = teams[i].tid;
				tname = teams[i].tname;
				document.getElementById("team").innerHTML += "<option value = '" + tid + "'>" + tname + "</option>";
			}
		
			function check() {
				var cname = document.getElementById("cname").value.trim();
				var sid = document.getElementById("seat2").value;
				var tid = document.getElementById("team").value;
				if(cname == "" || sid == "" || tid == "") {
					alert("Fields cannot be empty");
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
				document.getElementById("table").innerHTML = "<tr> <td> <b> Candidate Name </b> </td> <td> <b> Team Name </b> </td><td> <b> Symbol </b> </td> <td> <b> Obtained Votes </b> </td></tr>";
				var tname, symbol;
				for(var i = 0; i < candidates.length; i++) {
					if(candidates[i].sid == sid) {
						for(var j = 0; j < teams.length; j++) {
							if(teams[j].tid == candidates[i].tid) {
								tname = teams[j].tname;
								symbol = teams[j].symbol;
								break;
							}
						}
						document.getElementById("table").innerHTML += ("<tr> <td>" + candidates[i].cname + "</td> <td>" + tname + "</td> <td> <img src = 'http://localhost/eps/admin/team/symbols/" + symbol + "' width = '100' height = '100'> </td> <td>" + candidates[i].obtainedvotes + "</td> <td> <a href = 'delete.php?cnid=" + candidates[i].cnid + "'> Delete </td> </tr>");
					}
				}
				
			}
		</script>
	
	</body>


</html>