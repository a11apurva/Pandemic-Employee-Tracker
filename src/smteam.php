<?php
	session_start();
?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
						<li class="nav-item">
							<a class="nav-link" href="smhome.php">Home</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="smteam.php">Team
								<span class="sr-only">(current)</span>
							</a>
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
					echo "<h3 class=\"heading\">". $_SESSION["name"] ."'s direct team</h3>";
				} else {
					header("Location: login.php");
				}
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="card bg-light mb-3">
						<div class="card-header"><h3 class="text-center">My Team</h3></div>
						<div class="card-body">
							<?php 
								require "config.php";
								$link = mysqli_connect("$host", "$username", "$password", "$db");
								if ($link == false) {
									die ("ERROR: Could not connect. " . mysqli_connect_error());
								}
								$email = $_SESSION["email"];
								$sql = "SELECT emp_id FROM employees WHERE email = '$email'";
								if($result = mysqli_query($link, $sql)) {
									if(mysqli_num_rows($result) == 1) {
										while($row = mysqli_fetch_array($result)) {
											$mgr_emp_ID = $row['emp_id'];
										}
									}
								}
								$sql = "select distinct employees.name, emp_status.isAlone, emp_status.health, emp_status.zone, emp_status.state, emp_status.district, datediff(curdate(),since) as days from manages inner join employees on manages.emp_id=employees.emp_ID inner join emp_status on emp_status.emp_id=employees.emp_id where mgr_id = '$mgr_emp_ID' AND state= 'karnataka';";
	
								echo "<table class=\"table table-bordered\"><thead class=\"thead-dark\"><tr>";
								echo "<th width=\"20%\" class=\"text-center\">In Karnataka</th>";

								
								echo "<table class=\"table table-bordered\"><thead class=\"thead-dark\"><tr>";
								echo "<th width=\"15%\" class=\"text-center\">Name</th>";
								echo "<th width=\"15%\" class=\"text-center\">Alone</th>";
								echo "<th width=\"15%\" class=\"text-center\">Health</th>";
								echo "<th width=\"10%\" class=\"text-center\">Zone</th>";
								echo "<th width=\"15%\" class=\"text-center\">District</th>";
								echo "<th width=\"15%\" class=\"text-center\">Days Since</th>";
								echo "<th width=\"15%\" class=\"text-center\">Fit to Return</th>";
								echo "<tbody>";

								
								if($result = mysqli_query($link, $sql)) {
									while($row = mysqli_fetch_array($result)) {
										$name = $row['name'];
										$isAlone = $row['isAlone'];
										$health = $row['health'];
										$zone = $row['zone'];
										$district = $row['district'];
										$days = $row['days'];
										$state = $row['state'];
										
										if ($health == "Great" and $days >= 15 and $district == "Bengaluru Urban") {
											$return = "Yes";
										} else {
											$return = "No";
										}
										
										if ($zone == "Red") { 
											echo "<tr style=\"background-color:#fabbac\"><td>$name</td>";
											echo "<td>$isAlone</td>";
											echo "<td>$health</td>";
											echo "<td>$zone</td>";
											if ($district == "Bengaluru Urban"){
												echo "<td><font color=\"#0113AE\">$state"."- "."$district</font></td>";
											} else {
												echo "<td>$state"."- "."$district</td>";
											}
											echo "<td>$days</td>";
											echo "<td>$return</td></tr>";
										}
										elseif ($zone == "Green") {
											echo "<tr style=\"background-color:#d7fcca\"><td>$name</td>";
											echo "<td>$isAlone</td>";
											echo "<td>$health</td>";
											echo "<td>$zone</td>";
											if ($district == "Bengaluru Urban"){
												echo "<td><font color=\"#0113AE\">$state"."- "."$district</font></td>";
											} else {
												echo "<td>$state"."- "."$district</td>";
											}
											echo "<td>$days</td>";
											echo "<td>$return</td></tr>";
										}
										elseif ($zone == "Orange") {
											echo "<tr style=\"background-color:#fcfba7\"><td>$name</td>";
											echo "<td>$isAlone</td>";
											echo "<td>$health</td>";
											echo "<td>$zone</td>";
											if ($district == "Bengaluru Urban"){
												echo "<td><font color=\"#0113AE\">$state"."- "."$district</font></td>";
											} else {
												echo "<td>$state"."- "."$district</td>";
											}
											echo "<td>$days</td>";
											echo "<td>$return</td></tr>";
										}
										else {
											echo "<td>$isAlone</td>";
											echo "<td>$health</td>";
											echo "<td>$zone</td>";
											if ($district == "Bengaluru Urban"){
												echo "<td><font color=\"#0113AE\">$state"."- "."$district</font></td>";
											} else {
												echo "<td>$state"."- "."$district</td>";
											}
											echo "<td>$days</td>";
											echo "<td>$return</td></tr>";
										}
									}
									
								}
								
								echo "</table>";
								
								$sql = "select distinct employees.name, emp_status.isAlone, emp_status.health, emp_status.zone, emp_status.state, emp_status.district, datediff(curdate(),since) as days from manages inner join employees on manages.emp_id=employees.emp_ID inner join emp_status on emp_status.emp_id=employees.emp_id where mgr_id = '$mgr_emp_ID' AND state <> 'karnataka';";
								
								echo "<table class=\"table table-bordered\"><thead class=\"thead-dark\"><tr>";
								echo "<th width=\"20%\" class=\"text-center\">Other States</th>";
								echo "<tbody>";	
								
								echo "<table class=\"table table-bordered\"><thead class=\"thead-dark\"><tr>";
								echo "<th width=\"15%\" class=\"text-center\">Name</th>";
								echo "<th width=\"15%\" class=\"text-center\">Alone</th>";
								echo "<th width=\"15%\" class=\"text-center\">Health</th>";
								echo "<th width=\"10%\" class=\"text-center\">Zone</th>";
								echo "<th width=\"15%\" class=\"text-center\">District</th>";
								echo "<th width=\"15%\" class=\"text-center\">Days since</th>";
								echo "<th width=\"15%\" class=\"text-center\">Fit to return</th>";
								echo "<tbody>";
								
								if($result = mysqli_query($link, $sql)) {
									while($row = mysqli_fetch_array($result)) {
										$name = $row['name'];
										$isAlone = $row['isAlone'];
										$health = $row['health'];
										$zone = $row['zone'];
										$district = $row['district'];
										$days = $row['days'];
										$state = $row['state'];
										
										if ($health == "Great" and $days >= 15 and $district == "Bengaluru Urban") {
											$return = "Yes";
										} else {
											$return = "No";
										}
										
										if ($zone == "Red") { 
											echo "<tr style=\"background-color:#fabbac\"><td>$name</td>";
											echo "<td>$isAlone</td>";
											echo "<td>$health</td>";
											echo "<td>$zone</td>";
											if ($district == "Bengaluru Urban"){
												echo "<td><font color=\"#0113AE\">$state"."- "."$district</font></td>";
											} else {
												echo "<td>$state"."- "."$district</td>";
											}
											echo "<td>$days</td>";
											echo "<td>$return</td></tr>";
										}
										elseif ($zone == "Green") {
											echo "<tr style=\"background-color:#d7fcca\"><td>$name</td>";
											echo "<td>$isAlone</td>";
											echo "<td>$health</td>";
											echo "<td>$zone</td>";
											if ($district == "Bengaluru Urban"){
												echo "<td><font color=\"#0113AE\">$state"."- "."$district</font></td>";
											} else {
												echo "<td>$state"."- "."$district</td>";
											}
											echo "<td>$days</td>";
											echo "<td>$return</td></tr>";
										}
										elseif ($zone == "Orange") {
											echo "<tr style=\"background-color:#fcfba7\"><td>$name</td>";
											echo "<td>$isAlone</td>";
											echo "<td>$health</td>";
											echo "<td>$zone</td>";
											if ($district == "Bengaluru Urban"){
												echo "<td><font color=\"#0113AE\">$state"."- "."$district</font></td>";
											} else {
												echo "<td>$state"."- "."$district</td>";
											}
											echo "<td>$days</td>";
											echo "<td>$return</td></tr>";
										}
										else {
											echo "<td>$isAlone</td>";
											echo "<td>$health</td>";
											echo "<td>$zone</td>";
											if ($district == "Bengaluru Urban"){
												echo "<td><font color=\"#0113AE\">$state"."- "."$district</font></td>";
											} else {
												echo "<td>$state"."- "."$district</td>";
											}
											echo "<td>$days</td>";
											echo "<td>$return</td></tr>";
										}
									}
									
								}

								echo "</table>";	
								
								
                                $sql = "select count(emp_status.zone) as num from manages inner join employees on manages.emp_id=employees.emp_ID inner join emp_status on emp_status.emp_id=employees.emp_id where mgr_id = '$mgr_emp_ID' and emp_status.district='Bengaluru Urban';";							
								
								$data1 = array();
								if($result = mysqli_query($link, $sql)) {
									while($row = mysqli_fetch_array($result)) {
										$data1[] = $row["num"];
										#array_push($data1, $row);
									}
								}
									
                                $sql = "select count(emp_status.zone) as num from manages inner join employees on manages.emp_id=employees.emp_ID inner join emp_status on emp_status.emp_id=employees.emp_id where mgr_id = '$mgr_emp_ID' and emp_status.district<>'Bengaluru Urban';";							
								
								if($result = mysqli_query($link, $sql)) {
									while($row = mysqli_fetch_array($result)) {
										$data1[] = $row["num"];
									}
								}

								mysqli_close($link);
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
                <div class="col-md-12">
					<div class="card bg-light mb-12">
						<div class="card-header"><h3 class="text-center">Statistics</h3></div>
						<div class="card-body">
			                <div class="row">
			                    <div class="col-md-4">
			                    	<div class="card h-100">
			                    		<div class="card-body">	
			                    		    <canvas id="graphStatus"></canvas>
                                        </div>		
			                    	</div>	
			                    </div>	
			                    <div class="col-md-4">
			                    	<div class="card h-100">
			                    		<div class="card-body">	
			                    		    <canvas id="graphStatus2"></canvas>
                                        </div>		
			                    	</div>	
			                    </div>	
			                    <div class="col-md-4">
			                    	<div class="card h-100">
			                    		<div class="card-body">	
			                    		    <canvas id="graphStatus3"></canvas>
                                        </div>		
			                    	</div>	
			                    </div>
			                </div>
                        </div>
					</div>
				</div>			
			</div>
		</div>
		<br>
		<footer class="py-3 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">COVID Employee Tracker</p>
			</div>
		</footer>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script>
        	var ctx = $("#graphStatus");
        	var myChart = new Chart(ctx, {
        		type: 'doughnut',
        		data: {
        			labels: ["IN BANGALORE","OUTSIDE BANGALORE"],
        			datasets: [{
        				label: "status",
        				data: <?php echo json_encode($data1); ?>,
        				backgroundColor: [
        					"rgb(255, 99, 132)",
        					"rgb(155, 90, 134)",
        				]
        			}]
        		},
        		options: {
        			title: {
        				display: true,
        				fontSize: 20,
        				text: 'Current Status'
        			},
        			aspectRatio: 1
        		}
        	});
        </script>	
		<script>
        	var ctx = $("#graphStatus2");
        	var myChart = new Chart(ctx, {
        		type: 'doughnut',
        		data: {
        			labels: ["Red Zone","Green Zone", "Orange Zone"],
        			datasets: [{
        				label: "status",
        				data: [1,0,0],
        				backgroundColor: [
        					"rgb(255,99,71)",
        					"rgb(0, 128, 0)",
							"rgb(255, 140, 0)",
        				]
        			}]
        		},
        		options: {
        			title: {
        				display: true,
        				fontSize: 20,
        				text: 'In Bangalore'
        			},
        			aspectRatio: 1
        		}
        	});
        </script>
		<script>
        	var ctx = $("#graphStatus3");
        	var myChart = new Chart(ctx, {
        		type: 'doughnut',
        		data: {
        			labels: ["Red Zone","Green  Zone", "Orange Zone"],
        			datasets: [{
        				label: "status",
        				data: [0,1,0],
        				backgroundColor: [
        					"rgb(255,99,71)",
        					"rgb(0, 128, 0)",
							"rgb(255, 140, 0)",
        				]
        			}]
        		},
        		options: {
        			title: {
        				display: true,
        				fontSize: 20,
        				text: 'Outside Bangalore'
        			},
        			aspectRatio: 1
        		}
        	});
        </script>
	</body>
</html>