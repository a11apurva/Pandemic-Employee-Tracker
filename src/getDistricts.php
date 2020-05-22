<?php
	require 'config.php';
	$link = mysqli_connect("$host", "$username", "$password", "$db");
	if (!$link) {
		die ("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$state = mysqli_real_escape_string($link, $_POST['state']);
	$sql = "SELECT district FROM zones WHERE state = '$state' ORDER BY district";
	$output = "<option value=\"\" selected disabled>Select District</option>";
	if($result = mysqli_query($link, $sql)) {
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_array($result)) {
				$val = $row['district'];
				$output = $output . "<option value=\"$val\">$val</option>";
			}
		}
	}
	echo($output);
	mysqli_close($link);
?>