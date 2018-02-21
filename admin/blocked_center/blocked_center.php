<?php
	session_start();
	if(!isset($_SESSION['category']) || $_SESSION['category'] != "admin") {
		header("Location: http://localhost/eps");
	}
	
?>
<!DOCTYPE html>

<html>

	<head>
		<title> Blocked Centers </title>
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
			$sql = "select * from centers where status = 2";
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
		<h3> List of Blocked Centers </h3>
		<p> 
			Select district: 
			<select name = "district" id = "district" onChange = "change()"> <option> </option> </select> 
		</p>
		
		<p>
			Select seat:
			<select name = "seat" id = "seat" onChange = "load()"> <option> </option> </select>
		</p>
		
		<p> <button onClick = "showAll()"> Show all blocked centers </button> </p>
		
		
		<table width = "30%" id = "table">
			
		</table>
		
		
				
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
			}
		
			showAll();
			function change() {
				var did = document.getElementById("district").value;
				var sname, sid;
				document.getElementById("seat").innerHTML = "<option> </option>";

				for(var i = 0; i < seats.length; i++) {
					if(seats[i].did == did) {
						sname = seats[i].sname;
						sid = seats[i].sid;
						document.getElementById("seat").innerHTML += "<option value = '" + sid + "'>" + sname + "</option>";
					
						
					}
				}
			}
			
			function showAll() {
				if(centers[0] != "") {
					var sname;
					document.getElementById("table").innerHTML = "<tr> <td> <b> Center Name </b> </td> <td> <b> Seat Name </b> </td> </tr>";
					for(var i = 0; i < centers.length; i++) {
						for(var j = 0; j < seats.length; j++) {
							if(centers[i].sid == seats[j].sid) {
								sname = seats[j].sname;
								break;
							}
						}
						document.getElementById("table").innerHTML += ("<tr> <td>" + centers[i].cname + "</td> <td>" + sname + "</td> <td> <a href = 'unblock.php?cid=" + centers[i].cid + "'> Unblock </td> </tr>");
							
					}
				}
			}
			
			function load() {
				var sid = document.getElementById("seat").value;

				document.getElementById("table").innerHTML = "<tr> <td> <b> Center Name </b> </td> </tr>";
				for(var i = 0; i < centers.length; i++) {
					if(centers[i].sid == sid) 
						document.getElementById("table").innerHTML += ("<tr> <td>" + centers[i].cname + "</td> <td> <a href = 'unblock.php?cid=" + centers[i].cid + "'> Unblock </td> </tr>");
				}
	
			}
		</script>
	
	</body>


</html>