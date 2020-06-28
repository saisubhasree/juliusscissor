<?php
$servername = "fdb22.awardspace.net";
$username = "2846112_db";
$password = "js123!@#";
$dbname = "2846112_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
if(!isset($_SESSION["user"])){
        header("location:login.php");
        exit;
}
?>

<!DOCTYPE html>
<html>
<title>Julius Scissor - Administrator</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Julius Scissor</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amiri">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="styles.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <style>
        
        .scrollable{
        overflow:scroll;
        height:60%;
  
        }
        
        table td {
            width: 30px;
            overflow: hidden;
            display: inline-block;
            white-space: nowrap;
        }
        
        </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img class="navbar-logo" src="img/IS_logo3_transparent.png"></a>
		<p class="navbar-title">JULIUS SCISSOR</p>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="admin_index.php">HOME</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="modify_stylists.php">MODIFY STYLISTS</a>
				</li>
                                <li class="nav-item">
					<a class="nav-link" href="appointments_table.php">APPOINTMENTS</a>
				</li>
                                <li class="nav-item">
					<a class="nav-link" href="customers_table.php">CUSTOMERS</a>
				</li>
                                <li class="nav-item">
					<a class="nav-link" href="haircuts_table.php">HAIRCUTS</a>
				</li>
                                <li class="nav-item">
					<a class="nav-link active" href="hairstylists_table.php">HAIRSTYLISTS</a>
				</li>
                                <li class="nav-item">
					<a class="nav-link" href="timeslots_table.php">TIMESLOTS</a>
				</li>
			</ul>
		</div>
	</div>
</nav>


<?php
//retreive data on all the hairstylists
$query = "SELECT * from hairstylists;";

$results = mysqli_query($conn, $query);

?>

<div class="w3-container">
  <center><h2>Hairstylists</h2>
<div class="scrollable">
  <table class="w3-table-all w3-card-4 w3-round-large">
    <tr>
      <th>hairstylist_id</th>
      <th>hairstylist_name</th>
      <th>hairstylist_desc</th>
      <th>hairstylist_url</th>
      <th>status</th>
    </tr>
    
<?php
//looping through the data and echoing it into the table
while($result = mysqli_fetch_assoc($results)) {
	$hairstylist_id = $result['hairstylist_id'];
	$hairstylist_name = $result['hairstylist_name'];
	$hairstylist_desc = $result['hairstylist_desc'];
        $hairstylist_url = $result['hairstylist_url'];
        $status = $result['status'];
?>
    
    <tr>
      <td><?php echo $hairstylist_id?></td>
      <td><?php echo $hairstylist_name?></td>
      <td><?php echo $hairstylist_desc?></td>
      <td><?php echo $hairstylist_url?></td>
      <td><?php echo $status?></td>
    </tr>
    
<?php } ?>
   
  </table>
</div>

<br>
    <br>
    <br>

<!--- Footer -->
<footer>
<div class="container-fluid padding">
<div class="row text-center">
	<div class="col-md-4">
		<center><hr class="light"></center>
		<p>555-555-5555</p>
		<p>team29@tamu.edu</p>
		<p> College Station, TX, 77840 </p>
	</div>

	<div class="col-md-4">
		<center><hr class="light"></center>
		<h5>Our hours</h5>
		<center><hr class="light"></center>
		<p>Monday to Sunday: 8 am - 6 pm </p>
		<p>Contact us: 24/7 </p>
		<p>Public Holidays: closed </p>
	</div>

	<div class="col-md-4">
		<center><hr class="light"></center>
		<h5>Service Areas</h5>
		<center><hr class="light"></center>
		<p>San Francisco, CA, 94102  </p>
		<p>Seattle, WA, 98105 </p>
		<p>New York, NY, 10001</p>
	</div>

	<div class="col-12">
                <button type="button" class="btn btn-outline-light btn-lg" onclick="document.location.href = 'index.php';">Back to Website</button>
		<br><br>
		<center><hr class="light-100"></center>
		<h5>&copy; Developed by Team 29 </h5>
	</div>	
</div>
</div>
</footer>