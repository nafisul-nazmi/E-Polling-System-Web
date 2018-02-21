<?php 
		
	function getAdmins() {
		$conn = new mysqli("localhost", "root", "", "eps");
		$sql = "select * from admins";
		$result = $conn->query($sql);
		$conn->close();
		return $result;
	}
	
	function getCenters() {
		$conn = new mysqli("localhost", "root", "", "eps");
		$sql = "select sid, cid, password from centers";
		$result = $conn->query($sql);
		$conn->close();
		return $result;
	}
	
	function changeAdminPass($username, $password) {
		$conn = new mysqli("localhost", "root", "", "eps");
		$sql = "update admins set password = '$password' where username = '$username'";
		$conn->query($sql);
		$conn->close();
	}
	
	function changeCenterPass($cid, $password) {
		$conn = new mysqli("localhost", "root", "", "eps");
		$sql = "update centers set password = '$password' where cid = $cid";
		$conn->query($sql);
		$conn->close();
	}
	

?>