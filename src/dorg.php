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
							<a class="nav-link" href="dhome.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="dteam.php">Team</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="dorg.php">Organization
								<span class="sr-only">(current)</span>
							</a>
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
			
		    </br>
			
	        <div class="row">
                <div class="col-md-12">
	        		<div class="card bg-light mb-12">
	        			<div class="card-header"><h3 class="text-center">Organization</h3></div>
	        			<div class="card-body">
								<table class=\"table table-striped table-bordered\">
								<tr><div id="tree"/></tr>
								<center>
								<tr >
								    <td><img src="image/zone_green_ready.png" alt="" border=0 height=20 width=20></img></td>
									<td><b>Ready to return</b>
								    <td><img src="image/zone_green.png" alt="" border=0 height=20 width=20></img></td>
									<td><b>Greeen Zone</b>
								    <td><img src="image/zone_orange.png" alt="" border=0 height=20 width=20></img></td>
									<td><b>Orange Zone</b>
								    <td><img src="image/zone_red.png" alt="" border=0 height=20 width=20></img></td>
									<td><b>Red Zone</b>
								</tr>
								</center>
								</table>		    			    
		    	        </div>	
		    		</div>
		    	</div>
		    </div>
			
			</br>
			
			<div class="row">
				<div class="col-md-12">
					<div class="card bg-light mb-12">
						<div class="card-header"><h3 class="text-center">Floor wise distribution</h3></div>
						<div class="card-body">
							<?php 
								#require "config.php";
								#$link = mysqli_connect("$host", "$username", "$password", "$db");
								#if ($link == false) {
								#	die ("ERROR: Could not connect. " . mysqli_connect_error());
								#}
								#$email = $_SESSION["email"];
								#$sql = "SELECT * FROM employees WHERE email = '$email'";
								#if($result = mysqli_query($link, $sql)) {
								#	if(mysqli_num_rows($result) == 1) {
								#		while($row = mysqli_fetch_array($result)) {
								#			$emp_ID = $row['emp_ID'];
								#			$name = $row['name'];
								#			$phone = "+91-" . $row['phone'];
								#		}
								#	}
								#}
								echo "<table class=\"table table-striped table-bordered\">";
								echo "<tr><td><b>Wing</b></td><td><b>Capacity</b></td><td><b>Fit to Return</b></td></tr>";
								echo "<tr><td><b>0A</b></td><td>350</td><td>45</td></tr>";
								echo "<tr><td><b>1A</b></td><td>350</td><td>60</td></tr>";
								echo "<tr><td><b>1C</b></td><td>350</td><td>25</td></tr>";
								echo "<tr><td><b>2A</b></td><td>350</td><td>30</td></tr>";
								echo "<tr><td><b>2C</b></td><td>350</td><td>45</td></tr>";
								echo "<tr><td><b>3A</b></td><td>200</td><td>24</td></tr>";
								echo "<tr><td><b>3C</b></td><td>250</td><td>56</td></tr>";
								echo "<tr><td><b>4A</b></td><td>350</td><td>15</td></tr>";
								echo "<tr><td><b>4C</b></td><td>350</td><td>78</td></tr>";
								echo "<tr><td><b>5A</b></td><td>300</td><td>90</td></tr>";
								echo "<tr><td><b>5C</b></td><td>300</td><td>10</td></tr>";
								echo "</table>";
								#mysqli_close($link);
							?>
						</div>
					</div>
				</div>
			</div>
			
		    </br>
			
	        <div class="row">
                <div class="col-md-12">
	        		<div class="card bg-light mb-12">
	        			<div class="card-header"><h3 class="text-center">Floor Chart</h3></div>
	        			<div class="card-body">
								<?php 
								echo "<table class=\"table table-striped table-bordered\">";
								echo "<tr><td colspan='3' style='text-align:center'><b>Wing 1C</b></td></tr>";
								echo "<tr><td><b>Total Capacity</b></td><td><b>Current number of employess</b></td><td><b>Current percentage of employess</b></td></tr>";
								echo "<tr><td><b>350</b></td><td>87</td><td>25%</td></tr>";
								echo "</table>";
                                echo "<img src='image/layout2.jpg' border=0 alt='Card image cap' class='card-img-top embed-responsive-item'></img>";
								?>
		    	        </div>	
		    		</div>
		    	</div>
		    </div>
		</div>
         
		</br>

		<footer class="py-3 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">COVID Employee Tracker</p>
			</div>
		</footer>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="http://127.0.0.1:8080/covid/orgchart.js"></script>
        <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
        <script src="http://127.0.0.1:8080/covid/orgchart.js"></script>
        <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
		<script>
        	var ctx = $("#graphStatus");
        	var myChart = new Chart(ctx, {
        		type: 'doughnut',
        		data: {
        			labels: ["IN BANGALORE","OUTSIDE BANGALORE"],
        			datasets: [{
        				label: "status",
        				data: [16045,17000],
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
        				data: [200,400,150],
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
        				data: [300,200,150],
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
   <script>
        OrgChart.templates.ula.field_0 = '<text class="field_0"  style="font-size: 18px;" fill="#039BE5" x="100" y="45" >{val}</text>';
        OrgChart.templates.ula.field_1 = '<text class="field_0"  style="font-size: 14px;" fill="#afafaf" x="100" y="65" >{val}</text>';
        OrgChart.templates.ula.field_2 = '<text class="field_0"  style="font-size: 14px;" fill="#afafaf" x="100" y="85" >{val}</text>';
        OrgChart.templates.ula.img_1 = 
        '<image preserveAspectRatio="xMidYMid slice" xlink:href="{val}" x="220" y="5" width="25" height="25"></image>';
   
        var chart = new OrgChart(document.getElementById("tree"), {
            collapse: {
                level: 2
            },
            template: "ula",
			layout: OrgChart.tree,
            enableSearch: false,
            mouseScrool: OrgChart.action.none,
            nodeBinding: {
                field_0: "Name",
                field_1: "Zone",
				field_2: "District",
				field_3: "State",
				field_4: "Since",
                img_0: "img",
				img_1: "img2"
            },
            nodes: [
                { id: 1, Name: "Gaurav Vishesh", Zone: "Green Zone", District: "Bangalore", State: "Karnataka", Since: "63 days", img: "https://cdn.balkan.app/shared/empty-img-white.svg", img2: "image/Zone_green_ready.PNG" },
                { id: 2, pid: 1, Name: "Ashok Singh", Zone: "Orange Zone", District: "Hooghly", State: "West Bengal", Since: "45 days", img: "https://cdn.balkan.app/shared/empty-img-white.svg", img2: "image/Zone_orange.PNG"},
                { id: 3, pid: 1, Name: "Yogita Nama", Zone: "Red Zone", District: "Pune", State: "Maharashtra", Since: "43 days", img: "https://cdn.balkan.app/shared/empty-img-white.svg", img2: "image/Zone_red.PNG" },
				{ id: 4, pid: 1, Name: "Shreya Gowda", Zone: "Green Zone", District: "Udupi", State: "Karnataka", Since: "51 days", img: "https://cdn.balkan.app/shared/empty-img-white.svg", img2: "image/Zone_green.PNG" },
				{ id: 8, pid: 3, Name: "Niharika Sinha", Zone: "Green Zone", District: "Bangalore", State: "Karnataka", Since: "15 days", img: "https://cdn.balkan.app/shared/empty-img-white.svg" , img2: "image/Zone_green_ready.PNG"},
				{ id: 9, pid: 3, Name: "Apurva Vora", Zone: "Green Zone", District: "Bangalore", State: "Karnataka", Since: "71 days", img: "https://cdn.balkan.app/shared/empty-img-white.svg" , img2: "image/Zone_green_ready.PNG"},
				{ id: 10, pid: 3, Name: "Devansh Ojha", Zone: "Orange Zone", District: "Noida", State: "Karnataka", Since: "52 days", img: "https://cdn.balkan.app/shared/empty-img-white.svg" , img2: "image/Zone_orange.PNG"},
				{ id: 11, pid: 2, Name: "Anubhav Apurva", Zone: "Red Zone", District: "Ranchi", State: "Karnataka", Since: "49 days", img: "https://cdn.balkan.app/shared/empty-img-white.svg" , img2: "image/Zone_red.PNG"}
            ]
        });   
    </script>
	</body>
</html>