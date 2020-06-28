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
					<a class="nav-link active" href="admin_index.php">HOME</a>
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
					<a class="nav-link" href="hairstylists_table.php">HAIRSTYLISTS</a>
				</li>
                                <li class="nav-item">
					<a class="nav-link" href="timeslots_table.php">TIMESLOTS</a>
				</li>
			</ul>
		</div>
	</div>
</nav>


<?php
//following query is to count the number of appointments for the current date and display the information, it is done by joining appointment, customer and timeslots
$get_info_query = "SELECT a.appt_id, c.customer_fname, c.customer_lname, c.cell_number, c.email_id, t.timeslot_duration, a.appt_status FROM customers c, timeslots t, appointments a WHERE a.timeslot_id = t.timeslot_id AND a.customer_id = c.customer_id AND a.date_appt = DATE(CONVERT_TZ(now(),'+00:00','-5:00')) order by t.timeslot_id, a.appt_id;";
$get_count_info = "SELECT * from appointments a where a.appt_status <> 'Canceled' and a.date_appt = DATE(CONVERT_TZ(now(),'+00:00','-5:00')) order by a.appt_id;";

$info = mysqli_query($conn, $get_info_query);
$count_appointments = mysqli_num_rows(mysqli_query($conn, $get_count_info));

?>

<div class="w3-container">
  <center><h2>All appointments</h2>
  <p>List of appointments for <?php date_default_timezone_set("America/Chicago"); echo date("m/d/Y");?> <span class="w3-badge w3-green"><?php echo $count_appointments;?></span></p></center>
<div class="scrollable">
<!-- Following table will house all the data for the appointments -->
  <table class="w3-table-all w3-card-4 w3-round-large">
    <tr>
      <th>Appointment ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Cell number</th>
      <th>Email ID</th>
      <th>Time Slot</th>
      <th>Status</th>
    </tr>
    
<?php
//the while loop iterates through all the rows that are extracted with the sql query executed previously, each of the data is then echoed in the table
while($appointment = mysqli_fetch_assoc($info)) {
	$appt_id = $appointment['appt_id'];
	$customer_fname = $appointment['customer_fname'];
	$customer_lname = $appointment['customer_lname'];
	$cell_number = $appointment['cell_number'];
	$email_id = $appointment['email_id'];
	$timeslot_duration = $appointment['timeslot_duration'];
	$appt_status = $appointment['appt_status'];
?>
    
    <tr>
      <td><?php echo $appt_id?></td>
      <td><?php echo $customer_fname?></td>
      <td><?php echo $customer_lname?></td>
      <td><?php echo $cell_number?></td>
      <td><?php echo $email_id?></td>
      <td><?php echo $timeslot_duration?></td>
      <td><?php echo $appt_status?></td>
    </tr>
    
<?php } ?>
   
  </table>
</div>
  <br><br>
  <?php 
        //following php code extracts nape hair, hairstyle, etc. details and executes a sql query to insert that data in the database
        if(isset($_POST['checkin'])) {
        $nh=$_POST['nh'];
        $th=$_POST['th'];
        $sh=$_POST['sh'];
        $appt = $_POST['appt_option'];
        $stylist_val = $_POST['hairstylist_option'];
        $haircut = $_POST['hairstyle_option'];
        $checkin_query = "UPDATE appointments SET appt_status = 'Checked-In', haircut_id = ".$haircut.", hairstylist_id = ".$stylist_val.", nape_hair = ".$nh.", side_hair = ".$sh.", top_hair = ".$th." WHERE appt_id = ".$appt.";";
        if(mysqli_query($conn,$checkin_query)) {
        $success_msg = "<div style='margin-left:auto;margin-right:auto;width:40%' id = 'success_msg' class='w3-panel w3-pale-green w3-leftbar w3-rightbar w3-border-green w3-border'><p><center>Customer has been successfully checked in.</center></p></div><br><br><script>$(function() {setTimeout(function() { $('#successmsg').fadeOut(1500); }, 3000)})</script>";
        echo $success_msg;
        }
        }
        
        if(isset($_POST['cancel'])) {
        $appt = $_POST['appt_option'];
        $cancel_query = "UPDATE appointments SET appt_status = 'Canceled', hairstylist_id = null, nape_hair = null, side_hair = null, top_hair = null WHERE appt_id = ".$appt.";";
        if(mysqli_query($conn,$cancel_query)) {
        $cancel_msg="<div style='margin-left:auto;margin-right:auto;width:40%' class='w3-panel w3-pale-red w3-leftbar w3-rightbar w3-border-red'><p><center>Appointment successfully canceled</center></p></div><br><br>";
        echo $cancel_msg;
        }
        }
  ?>
  <div class="w3-card-4 w3-white" style="margin-left:auto; margin-right:auto;width:60%">
    
    <div class="w3-container w3-center">
      <h3>Check-in Tool</h3>
      <img src="img/mascot.jpg" alt="Avatar" style="width:30%">
      <!-- The following form is for extracting check in information and executing the php code -->
      <form action = "http://juliusscissor.dx.am/admin_index.php" method="POST">
      
      <select class="w3-select w3-round-xlarge w3-border" name="appt_option">
              <option value="" disabled selected>Appointment #</option>
              <?php
                      $appt_list = mysqli_query($conn, "SELECT * FROM appointments where date_appt = DATE(CONVERT_TZ(now(),'+00:00','-5:00')) order by appt_id;");
                      while($appointment = mysqli_fetch_assoc($appt_list)) {
                      $appt_id = $appointment['appt_id'];
                      
              ?>
              <option value="<?php echo $appt_id;?>"><?php echo $appt_id;?></option>
              <?php } ?>
      </select>
      <br><br>
      <select class="w3-select w3-round-xlarge w3-border" name="hairstyle_option">
              <option value="" disabled selected>Hairstyle</option>
              <?php
                      $style_list = mysqli_query($conn, "SELECT * FROM haircuts;");
                      while($style = mysqli_fetch_assoc($style_list)) {
                      $haircut_id = $style['haircut_id'];
                      $haircut_name = $style['haircut_name'];
                      
              ?>
              <option value="<?php echo $haircut_id;?>"><?php echo $haircut_id." - ".$haircut_name;?></option>
              <?php } ?>
      </select>  
      
      <div class="w3-section">
       
        Nape Hair: <input name = "nh" class="w3-input w3-round-xlarge" type="number" step="0.01" min="0" max="15">
        <br>
        Side Hair: <input name = "sh" class="w3-input w3-round-xlarge" type="number" step="0.01" min="0" max="15">
        <br>
        Top Hair: <input name = "th" class="w3-input w3-round-xlarge" type="number" step="0.01" min="0" max="15">
        <br><br>
        
        <select class="w3-select w3-round-xlarge w3-border" name="hairstylist_option">
              <option value="" disabled selected>Hairstylist</option>
              <?php
                      $hs_list = mysqli_query($conn, "SELECT * FROM hairstylists where status='A';");
                      while($stylist = mysqli_fetch_assoc($hs_list)) {
                      $stylist_name = $stylist['hairstylist_name'];
                      $stylist_id = $stylist['hairstylist_id'];
                      
              ?>
              <option value="<?php echo $stylist_id;?>"><?php echo $stylist_name;?></option>
              <?php } ?>
        </select>
        <br><br>
        <button type="submit" name="checkin" class="w3-button w3-green">Check-In</button><br><br>
        <button type="submit" name="cancel" class="w3-button w3-red">No-Show</button>
      </div>
      </form>
    </div>


  </div>
  
</div>

</body>
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

</html> 


