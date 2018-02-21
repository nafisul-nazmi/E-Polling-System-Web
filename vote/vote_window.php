<?php
	session_start();
	if(!isset($_SESSION["category"]) || $_SESSION["category"] != "voter") {
		header("Location: http://localhost/eps/login/view/voter_login.php");
	}
?>

<!DOCTYPE html>

<html>

	<head>
		<title> Vote </title>
	</head>
	
	<body>
		
		
			
		<p> NID: <input type = "text" name = "nid" id = "nid"> </p>
		
		<table width = "40%">
			
			<tr>
				<td> </td>
				<td> <b> Candidate Name </b> </td>
				<td> <b> Team </b> </td>
				<td> <b> Symbol </b> </td>
			</tr>
		
			<?php
				$sid = $_SESSION['sid'];
				$candidates = array(array());
				$teams = array(array());
				$conn = new mysqli("localhost", "root", "", "eps");
				$sql = "select tid, tname, symbol from teams";
				$result = $conn->query($sql);
				$i = 0;
				while($row = $result->fetch_assoc()) {
					$teams[$i]['tid'] = $row['tid'];
					$teams[$i]['tname'] = $row['tname'];
					$teams[$i]['symbol'] = $row['symbol'];
					$i++;
				}
				$sql = "select cnid, cname, tid from candidates where sid = $sid";
				$result = $conn->query($sql);
				$tid;
				$i = 0;
				while($row = $result->fetch_assoc()) {
					$candidates[$i]['cnid'] = $row['cnid'];
					$candidates[$i]['cname'] = $row['cname'];
					$tid = $row['tid'];
					for($j = 0; $j < count($teams); $j++) {
						if($teams[$j]['tid'] == $tid) {
							$candidates[$i]['tname'] = $teams[$j]['tname'];
							$candidates[$i]['symbol'] = $teams[$j]['symbol'];
							break;
						}
					}
					
					
					echo "<tr>";
					echo "<td> <input type = 'radio' name = 'cnid' value = '{$candidates[$i]['cnid']}'> </td>";
					echo "<td> {$candidates[$i]['cname']} </td>";
					echo "<td> {$candidates[$i]['tname']} </td>";
					echo "<td> <img src = 'http://localhost/eps/admin/team/symbols/" . $candidates[$i]['symbol'] . "'> </td>";
					echo "</tr>";
					$i++;
				}
				
				
				$conn->close();
			?>
			
			
		
		</table>
		<button onclick = "vote()"> Vote </button>
		
		<script>
			function vote() {
				var nid = document.getElementById('nid').value.trim();				
				var radios = document.querySelectorAll('input[type="radio"]:checked');
				var cnid = radios.length>0? radios[0].value: null;
				if(nid == "" || cnid == null) {
					alert("Enter NID and select a candidate");
					return;
				}
				var xmlhttp = new XMLHttpRequest();
				var url = "vote.php?nid=" + nid + "&cnid=" + cnid;
				xmlhttp.onreadystatechange = function() {
	                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                    alert(xmlhttp.responseText);
						location.reload();
	                }
	            }
	            xmlhttp.open("GET", url, true);
				xmlhttp.send();
			}
			
		</script>
		
		
	</body>
	
</html>