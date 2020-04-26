<?php
	$conn = new mysqli("localhost", "root", "", "patient_management_system") or die(mysqli_error());
	$conn->query("DELETE FROM `user` WHERE `user_id` = '$_GET[id]'") or die(mysqli_error());
	header("location:admin.php");
