<?php
$servername = "fdb22.awardspace.net";
$username = "2846112_db";
$password = "js123!@#";
$dbname = "2846112_db";

//creating connection with the database, using server name, username, password, database
$conn = mysqli_connect($servername, $username, $password, $dbname);

//cancelling connection if it fails and displaying error message
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
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
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
					<a class="nav-link" href="index.php">HOME</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#aboutUs">ABOUT US</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="stylists_link.php">OUR STYLISTS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#services">SERVICES</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#contact">CONTACT</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="appointment.php">APPOINTMENTS</a>
				</li>
			</ul>
		</div>
	</div>
</nav>


<div class="w3-animate-opacity">

<div class="w3-container w3-black">
  <!-- the class in h2 tag is a bootstrap class that animates the text fading it in and out -->
  <center><h2 class="w3-animate-fading">Our Stylists are the best there are...</h2></center>
</div>



<?php
//SQL query to select all hairstylists that are available
$get_stylists = "SELECT * FROM hairstylists where status='A';";
$stylists = mysqli_query($conn, $get_stylists);
//counter allows finding end of row and fitting only three hairstylists in a row
$counter = 0;
$numResults = mysqli_num_rows($stylists);
//following while loop runs through contents of each row received and places them in the table created
while($stylist = mysqli_fetch_assoc($stylists)) {
        $name=$stylist['hairstylist_name'];
        $desc=$stylist['hairstylist_desc'];
        $url=$stylist['hairstylist_url'];
        
        if($counter%3 == 0) {
?>
<!-- PHP sript echos contents of the table and it is repeated due to the while loop -->
<div class="w3-row-padding w3-margin-top">
		        <?php }?>
  <div class="w3-third">
    <div class="w3-card">
      <img src="<?php echo $url;?>" style="width:100%">
      <br><br>
      <div class="w3-container">
        <h1 class="nameofstylist"><?php echo $name;?></h1>
      	<p class="descstylist"><?php echo $desc;?></p>
      </div>
    </div>
  </div>
  <?php if(($counter+1)%3==0 or ($counter+1)==$numResults) { ?>
</div>
<br><br>
<?php } ?>
<?php $counter=$counter+1;
} ?>
</div>


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
                <button type="button" class="btn btn-outline-light btn-lg" onclick="document.location.href = 'admin_index.php';">Admin Login</button>
		<br><br>
		<center><hr class="light-100"></center>
		<h5>&copy; Developed by Team 29 </h5>
	</div>	
</div>
</div>
</footer>



</body>
</html>















 

