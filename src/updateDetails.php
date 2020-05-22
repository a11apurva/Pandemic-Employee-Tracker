<?php
	require 'config.php';
	$link = mysqli_connect("$host", "$username", "$password", "$db");
	if (!$link) {
		die ("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$emp_ID = mysqli_real_escape_string($link, $_POST['emp_ID']);
	$state = mysqli_real_escape_string($link, $_POST['state']);
	$district = mysqli_real_escape_string($link, $_POST['district']);
	$date = mysqli_real_escape_string($link, $_POST['date']);
	$alone = mysqli_real_escape_string($link, $_POST['alone']);
	$health = mysqli_real_escape_string($link, $_POST['health']);
	$sql = "UPDATE emp_status SET isAlone = '$alone', health = '$health', state = '$state', district = '$district', since = '$date', zone = (SELECT zone FROM zones WHERE state = '$state' AND district = '$district') WHERE emp_ID = $emp_ID";
	if(mysqli_query($link, $sql)) {
		echo "Details updated successfully";
	} else {
		echo ("Error updating data. Please try again");
	}
	mysqli_close($link);
?>