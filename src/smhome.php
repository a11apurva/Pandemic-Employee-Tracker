<?php
	session_start();
?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<title>Home</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a class="navbar-brand" href="#">COVID Employee Tracker</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="smhome.php">Home
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="smteam.php">Team</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="smorg.php">Organization</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="signoff.php">Sign Off</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container" style="margin-top: 70px;">
			<?php
				if($_SESSION["name"] != "") {
					echo "<h3 class=\"heading\">Welcome, " . $_SESSION["name"] . "</h3>";
				} else {
					header("Location: login.php");
				}
			?>
			<div class="row">
				<div class="col-md-6">
					<div class="card bg-light mb-3 h-100">
						<div class="card-header"><h3 class="text-center">My Profile</h3></div>
						<div class="card-body">
							<?php 
								require "config.php";
								$link = mysqli_connect("$host", "$username", "$password", "$db");
								if ($link == false) {
									die ("ERROR: Could not connect. " . mysqli_connect_error());
								}
								$email = $_SESSION["email"];
								$sql = "SELECT * FROM employees WHERE email = '$email'";
								if($result = mysqli_query($link, $sql)) {
									if(mysqli_num_rows($result) == 1) {
										while($row = mysqli_fetch_array($result)) {
											$emp_ID = $row['emp_ID'];
											$name = $row['name'];
											$phone = "+91-" . $row['phone'];
										}
									}
								}
								echo "<table class=\"table table-striped table-bordered\">";
								echo "<tr><td><b>Employee ID</b></td><td><p id=\"e_id\">$emp_ID</p></td></tr>";
								echo "<tr><td><b>Name</b></td><td>$name</td></tr>";
								echo "<tr><td><b>Email</b></td><td>$email</td></tr>";
								echo "<tr><td><b>Phone</b></td><td>$phone</td></tr>";
								echo "</table>";
								mysqli_close($link);
							?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card bg-light mb-3 h-100">
						<div class="card-header"><h3 class="text-center">Location & Health</h3></div>
						<div class="card-body">
							<?php 
								require "config.php";
								$link = mysqli_connect("$host", "$username", "$password", "$db");
								if ($link == false) {
									die ("ERROR: Could not connect. " . mysqli_connect_error());
								}
								$email = $_SESSION["email"];
								$sql = "SELECT state,district,zone,isAlone,health,DATEDIFF(CURDATE(),since) AS days from emp_status where emp_ID IN (SELECT emp_id FROM employees WHERE email = '$email')";
								if($result = mysqli_query($link, $sql)) {
									if(mysqli_num_rows($result) == 1) {
										while($row = mysqli_fetch_array($result)) {
											$state = $row['state'];
											$district = $row['district'];
											$zone = $row['zone'];
											$isAlone = $row['isAlone'];
											$health = $row['health'];
											$since = $row['days'];
										}
									}
								}
								echo "<table class=\"table table-striped table-bordered\">";
								echo "<tr><td><b>State</b></td><td>$state</td></tr>";
								echo "<tr><td><b>District</b></td><td>$district</td></tr>";
								echo "<tr><td><b>Since</b></td><td>$since days</td></tr>";
								echo "<tr><td><b>Staying with</b></td><td>$isAlone</td></tr>";
								echo "<tr><td><b>How are you feeling</b></td><td>$health</td></tr>";
								echo "</table>";
								mysqli_close($link);
								// Query to get manager details - SELECT name,email,phone FROM employees WHERE emp_id = (SELECT mgr_id FROM manages WHERE emp_id = 1009)
							?>
							<button type="button" class="btn btn-primary btn-block" style="background-color: #00b388;" data-toggle="modal" data-target="#updateDetails">Update Details</button>
							<!--modal code goes here -->
							<div class="modal fade" id="updateDetails" tabindex="-1" role="dialog" aria-labelledby="updateDetailsLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form id="update_form" method="post">
										<div class="modal-header">
											<h5 class="modal-title" id="updateDetailsLabel">Update Details</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<select class="form-control" id="state" name="state" required>
												<option value="" selected disabled>Select State</option>
												<?php 
													require 'config.php';
													$link = mysqli_connect("$host", "$username", "$password", "$db");
													if (!$link) {
														die ("ERROR: Could not connect. " . mysqli_connect_error());
													}
													$sql = "SELECT DISTINCT state FROM zones ORDER BY state";
													if($result = mysqli_query($link, $sql)) {
														if(mysqli_num_rows($result) > 0) {
															while($row = mysqli_fetch_array($result)) {
																$val = $row['state'];
																echo "<option value=\"$val\">$val</option>";	
															}
														}
													}
													mysqli_close($link);
												?>
											</select>
											<small id="state_help" class="form-text text-muted">Which State are you in ?</small><br>
											<select class="form-control" id="district" name="district" required>
												<option value="" selected disabled>Select District</option>
											</select>
											<small id="district_help" class="form-text text-muted">Which District are you in ?</small><br>
											<input type="date" class="form-control" id="date">
											<small id="date_help" class="form-text text-muted">Since when are you staying in your current location ?</small><br>
											<select class="form-control" id="alone" name="alone" requird>
												<option value="" selected disabled>Staying With</option>
												<option value="Alone">Alone <span>&#128589;</span></option>
												<option value="Family">Family <span>&#128106;</span></option>
												<option value="Flatmates">Flatmates <span>&#129395;</span></option>
											</select>
											<small id="alone_help" class="form-text text-muted">Who are you staying with ?</small><br>
											<select class="form-control" id="health" name="health" required>
												<option value="" selected disabled>How are you feeling</option>
												<option value="Great">Great <span>&#128522;</span></option>
												<option value="Quarantine">Quarantine <span>&#128567;</span></option>
												<option value="Unwell">Unwell <span>&#129298;</span></option>
											</select>
											<small id="health_help" class="form-text text-muted">We hope you are fit and fine</small><br>
										</div>
										</form>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" id="save" name="save" class="btn btn-primary" style="background-color: #00b388;">Save changes</button>
										</div>
									</div>
								</div>
							</div>
							<!--modal end-->
						</div>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12">
					<div class="card bg-light mb-3">
						<?php
							echo "<div class=\"card-header\" style=\"background-color:$zone; color: white;\"><h3 class=\"text-center\">You are in $zone Zone</h3></div>";
						?>
					</div>
				</div>
			</div>
		</div>
		<footer class="py-3 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">COVID Employee Tracker</p>
			</div>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>

<script>
	$(document).ready(function(){
		$('#save').on('click', function(event){
			event.preventDefault();
			var state = $('#state').val();
			var district = $('#district').val();
			var date = $('#date').val();
			var alone = $('#alone').val();
			var health = $('#health').val();
			var emp_ID = $('#e_id').html();
				
			if(state == null){
				alert('We need to know which state are you in');
			} else if(district == null){
				alert('We need to know which district are you in');
			} else if(date == ""){
				alert('We need to know how many days have you spent in your current location');
			} else if(alone == null){
				alert('We need to know if you are alone and need help');
			} else if(health == null){
				alert('We need to know how you feel currently');
			}else {
				$.ajax({
					url: "updateDetails.php",
					type: "POST",
					data: {
						emp_ID: emp_ID,
						state: state,
						district: district,
						date: date,
						alone: alone,
						health: health
					},
					beforeSend: function(){
						
					},
					success: function(data){
						$('#update_form')[0].reset();
						alert(data);
						$('#updateDetails').modal('hide');
						location.reload();
					}
				});
			}
		});
	});

	$('#state').change(function(){
		var state = $('#state').val();
		console.log(state);
		$.ajax({
			url: "getDistricts.php",
			type: "POST",
			data: {state: state},
			beforeSend: function() {
				$("#district").addClass("loader");
			},
			success: function(data){
				$("#district").html(data);
				$("#district").removeClass("loader");
			}
		});
	});
</script>