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

error_reporting(0);
session_start();
if(!isset($_SESSION["user"])){
        header("location:login.php");
        exit;
}

#Updates
//Update the hairstylist name and description by using the update query
if(isset($_POST['modify'])) {
        $get_ids = "SELECT hairstylist_id from hairstylists";
        $get_id = mysqli_query($conn, $get_ids);
        $update_sql = "";
        while($id_emp = mysqli_fetch_assoc($get_id)) {
                $hidden_id_parameter = "stylist_id".$id_emp['hairstylist_id'];
                $name_parameter = "name".$id_emp['hairstylist_id'];	
                $desc_parameter = "desc".$id_emp['hairstylist_id'];
                $update_sql = $update_sql." "."UPDATE hairstylists SET hairstylist_name='".$_POST[$name_parameter]."', 
					hairstylist_desc='".$_POST[$desc_parameter]."'
					WHERE hairstylist_id=".$_POST[$hidden_id_parameter].";";
        }
        
        $queries = explode(";", $update_sql);
        foreach ($queries as $query) {
                $update_query = mysqli_query($conn, $query);
                if($update_query) {
                        echo "<div class='w3-container'><div class='w3-panel w3-pale-green w3-leftbar w3-rightbar w3-border-green'><p>Updated Successfully</p></div></div>";
                }
        }
        
        
}

#Deletes
//Update the status of the hairstylist as "I" which means he is unavailable for bookings when the hairstylist leaves the salon
$get_delete_ids = "SELECT hairstylist_id from hairstylists;";
$get_delete_id = mysqli_query($conn, $get_delete_ids);
$delete_sql = "";
while($id_delete_emp = mysqli_fetch_assoc($get_delete_id)) {
      $condition_delete = "delete".$id_delete_emp['hairstylist_id'];
      if(isset($_POST[$condition_delete])) {
      $delete_sql = "UPDATE hairstylists SET status = 'I' where hairstylist_id=".$id_delete_emp['hairstylist_id'].";";
      $delete_confirmation=mysqli_query($conn, $delete_sql); 
      if($delete_confirmation) {
                        echo "<div class='w3-container'><div class='w3-panel w3-pale-green w3-leftbar w3-rightbar w3-border-green'><p>Removed Successfully</p></div></div>";
               }
      }
}
?>

<!DOCTYPE html>
<html>
<title>Julius Scissor</title>
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
					<a class="nav-link active" href="modify_stylists.php">MODIFY STYLISTS</a>
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
<br><br>

<!-- Iterate through each hairstylist from the hairstylists table -->
<?php $get_stylists = "SELECT * FROM hairstylists where status ='A'";
$list_stylists = mysqli_query($conn, $get_stylists);
while($row = mysqli_fetch_assoc($list_stylists)) {
    $name=$row['hairstylist_name'];
    $desc=$row['hairstylist_desc'];
    $id=$row['hairstylist_id'];

?>

<!-- Sending hidden values to the server to identify the hairstylist id along with name and desc using hidden input type -->
<form action="" method="POST">
<div class="w3-container">
  <div class="w3-card-4">
    <div class="w3-container w3-black">
      <h2><?php echo $name?></h2>
    </div>

      <br><br>
      <p>
      &nbsp; <b>Name:</b> <input name="name<?php echo $id?>" class="w3-input" type="text" value="<?php echo $name ?>">
      <input type="hidden" name="stylist_id<?php echo $id?>" value="<?php echo $id?>">
      <p>
      &nbsp; <b>Description:</b> 
      <textarea class="w3-input" name="desc<?php echo $id?>" type="text"><?php echo $desc;?></textarea>
      <br><center><button type="submit" name="delete<?php echo $id?>" value="<?php echo $id;?>" class="w3-btn w3-ripple w3-red">Delete</button></center><br><br></center>
      <br><br>
 
  </div>
   <br><br>
</div>
<?php
}
?>
<center><button type="submit" name="modify" class="w3-btn w3-ripple w3-black">Update changes</button><br><br></center>
</form> 

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