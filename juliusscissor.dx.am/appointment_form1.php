<?php
$servername = "fdb22.awardspace.net";
$username = "2846112_db";
$password = "js123!@#";
$dbname = "2846112_db";

//creating connection with the database, using server name, username, password, database
$conn = mysqli_connect($servername, $username, $password, $dbname);


//Cancelling connection to the database and displaying error message if it fails
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//Storing the values of first name, last name, email, phone number and chosen time slot
$Fname = $_POST['fname'];
$Lname = $_POST['lname'];
$email = $_POST['email'];
$cellNum = $_POST['cell_number'];
$option = $_POST['option'];
$error_flag = 0;


//Finding if the customer is an existing customer and retrieving his email id
$get_rows = "SELECT * from customers";
$get_row = mysqli_query($conn, $get_rows);

$customer_present = 0;

while($row = mysqli_fetch_assoc($get_row)){
  if (strcasecmp($email, $row['email_id']) == 0) {
    $customer_present = 1;
    $cust_id = $row['customer_id'];
    break;
  }
}


//If it is a new customer, then adding the customer to the customers table
if($customer_present == 0){
  $sql = "INSERT INTO customers (customer_fname, customer_lname, cell_number, email_id) VALUES ('$Fname','$Lname','$cellNum','$email')";
  mysqli_query($conn, $sql);

  $cust_id = mysqli_insert_id($conn);

}


//Switch case to extract the timeslot id from the timeslot option
switch ($option) {
    case "8:00 AM - 9:00 AM":
        $timeslot = "1";
        break;
    case "9:00 AM - 10:00 AM":
        $timeslot = "2";
        break;
    case "10:00 AM - 11:00 AM":
        $timeslot = "3";
        break;
    case "11:00 AM - 12:00 PM":
        $timeslot = "4";
        break;
    case "1:00 PM - 2:00 PM":
        $timeslot = "5";
        break;
    case "2:00 PM - 3:00 PM":
        $timeslot = "6";
        break;
    case "3:00 PM - 4:00 PM":
        $timeslot = "7";
        break;
    case "4:00 PM - 5:00 PM":
        $timeslot = "8";
        break;
    case "5:00 PM - 6:00 PM":
        $timeslot = "9";
        break;
    }


 //Inserting the appointment to the appointments table
 date_default_timezone_set("America/Chicago");
 $tomorrow_date = date("Y-m-d", strtotime('tomorrow'));

 $sql2 = "INSERT INTO appointments (side_hair, top_hair, nape_hair, date_appt, timeslot_id, haircut_id, customer_id, hairstylist_id, appt_status) VALUES (NULL,NULL,NULL,'$tomorrow_date','$timeslot',NULL,'$cust_id',NULL,'Booked')";
 mysqli_query($conn, $sql2);
 
 $appt_id = mysqli_insert_id($conn);


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


<!-- Displaying the Appointment Confirmation -->

<div class="w3-row-padding padding">
<div class="w3-container w3-animate-left w3-card-4">
  <div style="float:left">
 	<img src="img/mascot.jpg" class="mascot-img">	
  </div>
  <br>
  <center><h2>Appointment Confirmation</h2></center>
  
  <br>
  First Name: <?php echo $Fname ?>
  <br>
  Last Name: <?php echo $Lname ?>
  <br>
  Email: <?php echo $email ?>
  <br>

  Time Slot: <?php echo $option?>
  <br>
  Appointment ID: <?php echo $appt_id?>
  <br>

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

