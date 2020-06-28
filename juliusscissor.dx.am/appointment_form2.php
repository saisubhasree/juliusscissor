<?php
$servername = "fdb22.awardspace.net";
$username = "2846112_db";
$password = "js123!@#";
$dbname = "2846112_db";

//creating connection with the database, using server name, username, password, database
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Store the values of appointment id and email id of the customer
$Appt_id = $_POST['appt_id'];
$Email_id = $_POST['email_id'];

//Find the corresponding appointment row for the customer
$get_rows = "SELECT * FROM appointments INNER JOIN customers ON appointments.customer_id = customers.customer_id";
$get_row = mysqli_query($conn, $get_rows);

$error_flag=1;


while($row = mysqli_fetch_assoc($get_row)){
  if($Appt_id == $row['appt_id'] && (strcasecmp($Email_id, $row['email_id']) == 0)) {
    $cust_id = $row['customer_id'];
    $cust_fname = $row['customer_fname'];
    $cust_lname = $row['customer_lname'];
    $timeslot_id = $row['timeslot_id'];
    $appt_status = $row['appt_status'];
    $error_flag=0;
    
//Use switch case to retrieve the timeslot option for the timeslot id
    switch ($timeslot_id) {
    case "1":
        $timeslot = "8:00 AM - 9:00 AM";
        break;
    case "2":
        $timeslot = "9:00 AM - 10:00 AM";
        break;
    case "3":
        $timeslot = "10:00 AM - 11:00 AM";
        break;
    case "4":
        $timeslot = "11:00 AM - 12:00 PM";
        break;
    case "5":
        $timeslot = "1:00 PM - 2:00 PM";
        break;
    case "6":
        $timeslot = "2:00 PM - 3:00 PM";
        break;
    case "7":
        $timeslot = "3:00 PM - 4:00 PM";
        break;
    case "8":
        $timeslot = "4:00 PM - 5:00 PM";
        break;
    case "9":
        $timeslot = "5:00 PM - 6:00 PM";
        break;
    }

    $get_rows2 = "SELECT * FROM timeslots WHERE timeslot_id = ' ". $timeslot_id. " '";
    $get_row2 = mysqli_query($conn, $get_rows2);
    $row2 = mysqli_fetch_assoc($get_row2);
  }
}

//If appointment id or email id is incorrect, then display the following error message
$message ="";
if($error_flag==1){ 
$message = "<br><br><center><p class=\"error_message\">Your appointment could not be found, please verify your details and try again!</p></center>";
$message2 = "<div class=\"error_message2\">";
$message3 = "</div>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Julius Scissor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  
  
  
  <style>
  .padding {
      padding-left:20%;
      padding-right:20%;
      padding-top: 5%;
    }
    
    .error_message {
       color:#FE3105;
    }
    
    .error_message2 {
       display:none;
    }
    
    .status {
       color:#FE3105;
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
					<a class="nav-link" href="index.php">HOME</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#aboutUs">ABOUT US</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="stylists_link.php">OUR STYLISTS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#services">SERVICES</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://juliusscissor.dx.am/index.php#contact">CONTACT</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="appointment.php">APPOINTMENTS</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Retrieval of Appointment -->

<div class="w3-row-padding padding">
<div class="w3-container w3-animate-left w3-card-4">
  <div style="float:left">
 	<img src="img/mascot.jpg" class="mascot-img">	
  </div>
  <br>
  <center><h2>Appointment Confirmation</h2></center>
  <?php echo $message ?>
  <br>
  <?php echo $message2 ?>      
  First Name: <?php echo $cust_fname; ?>
  <br>
  Last Name: <?php echo $cust_lname; ?>
  <br>

  Time Slot: <?php echo $timeslot; ?>
  <br>
  
  Appointment Status: <b class="status"> <?php echo $appt_status; ?> </b>
  <?php echo $message3 ?>

  <br><br>
  <center><p><button onclick="document.location.href = 'appointment.php';" class="w3-btn w3-black">Back</button></p></center>
</div>
</div>

<br><br>


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
		<center><hr class="light-100"></center>
		<h5>&copy; Developed by Team 29 </h5>
	</div>	
</div>
</div>
</footer>



</body>
</html>

